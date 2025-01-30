<?php

namespace App\Controller;

use App\Repository\TournoiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
