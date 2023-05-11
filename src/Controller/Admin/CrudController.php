<?php

namespace App\Controller\Admin;

use App\Data\CrudInterfaceData;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * @template E
 */
class CrudController extends AbstractController
{
    /**
     * @var class-string<E>
     */

    protected string $entity = '';
    protected string $templatePath = '';
    protected string $routePrefix = '';
    protected bool $indexOnSave = true;
    protected EntityManagerInterface $em;
    protected RequestStack $requestStack;

    public function __construct(EntityManagerInterface $em,RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function crudIndex(): Response
    {
        $rows = $this->getRepository()->findAll();
        return $this->render("admin/{$this->templatePath}/index.html.twig", [
            'rows' => $rows,
        ]);
    }

    public function crudEdit(CrudInterfaceData $data): Response
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $form = $this->createForm($data->getFormClass(), $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var E $entity */
            $entity = $data->getEntity();
            $old = clone $entity;
            $data->hydrate();
            $this->em->flush();
            $this->addFlash('success', 'Le contenu a bien été modifié');

            return $this->redirectAfterSave($entity);
        }

        return $this->render("admin/{$this->templatePath}/edit.html.twig", [
            'form' => $form->createView(),
            'entity' => $data->getEntity(),
        ]);
    }

    public function crudNew(CrudInterfaceData $data): Response
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $form = $this->createForm($data->getFormClass(), $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var E $entity */
            $entity = $data->getEntity();
            $data->hydrate();
            $this->em->persist($entity);
            $this->em->flush();

            $this->addFlash('success', 'Le contenu a bien été créé');

            return $this->redirectAfterSave($entity);
        }

        return $this->render("admin/{$this->templatePath}/new.html.twig", [
            'form' => $form->createView(),
            'entity' => $data->getEntity(),
        ]);
    }

    public function crudDelete(object $entity, ?string $redirectRoute = null): RedirectResponse
    {
        $this->em->remove($entity);

        $this->em->flush();
        $this->addFlash('success', 'Le contenu a bien été supprimé');

        return $this->redirectToRoute($redirectRoute ?: ($this->routePrefix.'_index'));
    }


    /**
     * @param E $entity
     */
    protected function redirectAfterSave($entity): RedirectResponse
    {
        if ($this->indexOnSave) {
            return $this->redirectToRoute($this->routePrefix.'_index');
        }

        return $this->redirectToRoute($this->routePrefix.'_edit', ['id' => $entity->getId()]);
    }


    public function getRepository(): EntityRepository
    {
        /* @var EntityRepository */
        return $this->em->getRepository($this->entity);
    }


}