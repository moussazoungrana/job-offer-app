<?php

namespace App\Controller\Admin;

use App\Data\JobOfferCrudData;
use App\Entity\JobOffer;
use App\Form\JobOfferType;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/offer")
 */
class JobOfferController extends CrudController
{
    protected string $templatePath = 'offer';

    protected string $entity = JobOffer::class;
    protected string $routePrefix = 'admin_offer';
    protected bool $indexOnSave = false;


    /**
     * @Route("/",name="admin_offer_index")
     */
    public function index(): Response
    {
       return $this->crudIndex();
    }

    /**
     * @Route("/news", name="admin_offer_new", methods={"GET","POST"})
     */
    public function new(): Response
    {
        $entity = new JobOffer();
        $data = new JobOfferCrudData($entity);
       return $this->crudNew($data);
    }

    /**
     * @Route("/{id}/edit", name="admin_offer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobOffer $offer): Response
    {
        $data = (new JobOfferCrudData($offer));
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}/delete", name="admin_offer_delete", methods={"POST"})
     */
    public function delete(Request $request, JobOffer $offer): Response
    {
        $token = $request->request->get('token');
        if (!$this->isCsrfTokenValid('delete', $token)) {
            return $this->redirectToRoute('admin_offer_index');
        }
        return $this->crudDelete($offer);
    }
}
