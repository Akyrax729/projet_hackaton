<?php

namespace App\Controller;

use App\Entity\Tournoi;
use App\Form\TournoiType;
use App\Repository\TournoiRepository;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TournoiController extends AbstractController
{
    #[Route('/tournois', name: 'app_tournois')]
    public function index(TournoiRepository $tournoiRepository): Response
    {
        $tournois = $tournoiRepository->findAll();

        return $this->render('tournoi/tournoi.html.twig', [
            'tournois' => $tournois,
        ]);
    }

    #[Route('/tournoi/create', name: 'app_tournoi_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        if (!$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Accès refusé. Seuls les admins peuvent créer un tournoi.');
            return $this->redirectToRoute('app_tournois');
        }

        
        $tournoi = new Tournoi();
        $form = $this->createForm(TournoiType::class, $tournoi);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tournoi->setCreePar($this->getUser());
            $tournoi->setCreatedAt(new \DateTime());

            $entityManager->persist($tournoi);
            $entityManager->flush();

            $this->addFlash('success', 'Tournoi créé avec succès !');
            return $this->redirectToRoute('app_tournois');
        }

        return $this->render('tournoi/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'app_tournoi_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Tournoi $tournoi, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Tournoi modifié avec succès !');
            return $this->redirectToRoute('app_tournois');
        }

        return $this->render('tournoi/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_tournoi_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Tournoi $tournoi, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tournoi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tournoi);
            $entityManager->flush();
            $this->addFlash('success', 'Tournoi supprimé avec succès !');
        }

        return $this->redirectToRoute('app_tournois');
    }
}



