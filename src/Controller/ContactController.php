<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ContactController extends AbstractController{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        return $this->render('contact/contact.html.twig', [
            'contactform'=>$form->createView(),
            
        ]);
    }
}
