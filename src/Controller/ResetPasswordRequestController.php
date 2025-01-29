<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ResetPasswordRequestController extends AbstractController{
    #[Route('/reset/password/request', name: 'app_reset_password_request')]
    public function index(): Response
    {
        return $this->render('reset_password_request/index.html.twig', [
            'controller_name' => 'ResetPasswordRequestController',
        ]);
    }
}
