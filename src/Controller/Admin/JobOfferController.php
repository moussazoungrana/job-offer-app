<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use App\Form\JobOfferType;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/offers")
 */
class JobOfferController extends AbstractController
{
    protected JobOfferRepository $offerRepository;
    protected EntityManagerInterface $em;

    public function __construct(JobOfferRepository $offerRepository, EntityManagerInterface $em)
    {
        $this->offerRepository = $offerRepository;
        $this->em = $em;
    }

    /**
     * @Route("/",name="admin_offers_index")
     */
    public function index(): Response
    {
        $offers = $this->offerRepository->findAll();
        return $this->render('admin/offers/index.html.twig', [
            'offers' => $offers,
        ]);
    }

    /**
     * @Route("/news", name="admin_offers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $offer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $offer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($offer);
            $this->em->flush();
            return $this->redirectToRoute('admin_offers_index');
        }

        return $this->render('admin/offers/new.html.twig', [
            'offer' => $offer,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_offers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobOffer $offer): Response
    {
        $form = $this->createForm(JobOfferType::class, $offer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($offer);
            $this->em->flush();
            return $this->redirectToRoute('admin_offers_index');
        }

        return $this->render('admin/offers/edit.html.twig', [
            'form' => $form->createView(),
            'offer' => $offer
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin_offers_delete", methods={"POST"})
     */
    public function delete(Request $request, JobOffer $offer): Response
    {
        $token = $request->request->get('token');
        if (!$this->isCsrfTokenValid('delete', $token)) {
            return $this->redirectToRoute('admin_offers_index');
        }
        $this->em->remove($offer);
        $this->em->flush();
        return $this->redirectToRoute('admin_offers_index');
    }
}
