<?php

namespace App\Controller;

use App\Repository\TournoiRepository;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(TournoiRepository $tournoiRepo, EquipeRepository $equipeRepo): Response
    {
        
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $tournois = $tournoiRepo->findBy(['cree_par' => $user]);
        $equipes = $equipeRepo->findBy(['cree_par' => $user]);

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'tournois' => $tournois,
            'equipes' => $equipes,
        ]);
    }
}

