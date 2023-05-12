<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="admin_login")
     */
    public function index(): Response
    {
        return $this->render('admin/auth/login.html.twig');
    }
}
