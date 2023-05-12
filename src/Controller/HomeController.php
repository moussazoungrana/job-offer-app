<?php

namespace App\Controller;


use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{

    protected JobOfferRepository $offerRepository;

    public function __construct(JobOfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @Route("/",name="home",methods={"GET"})
     */
    public function index(): Response
    {
        $offers = $this->offerRepository->findBy(['active' => true]);
        return $this->render('home.html.twig',[
            'offers' => $offers
        ]);
    }
}