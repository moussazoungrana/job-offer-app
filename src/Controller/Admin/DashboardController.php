<?php

namespace App\Controller\Admin;


use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{

    protected JobOfferRepository $offerRepository;

    public function __construct(JobOfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @Route("/",name="admin",methods={"GET"})
     */
    public function index(): Response
    {
        $offerCount = $this->offerRepository->count([]);
        return $this->render('admin/dashboard/index.html.twig',[
            'offerCount' => $offerCount
        ]);
    }
}