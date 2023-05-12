<?php

namespace App\Controller;


use App\Entity\JobOffer;
use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/offers")
 */
class JobOfferController extends AbstractController
{

    protected JobOfferRepository $offerRepository;

    public function __construct(JobOfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @Route("/",name="offer_index",methods={"GET"})
     */
    public function index(): Response
    {
        $offers = $this->offerRepository->findLatestActive();
        return $this->render('offers/index.html.twig',[
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/{id}/show",name="offer_show",methods={"GET"})
     */
    public function show(JobOffer $offer): Response
    {
        return $this->render('offers/show.html.twig',[
            'offer' => $offer
        ]);
    }
}