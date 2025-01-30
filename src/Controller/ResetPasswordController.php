<?php

namespace App\Controller;

use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ResetPasswordController extends AbstractController{
    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function index(string $token, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
       $user = $userRepository->findOneBy(['resetToken' => $token]);
       if (!$user || !$user->isResetTokenValid()) {
        $this->addFlash('danger', 'Ce lien de réinitialisation est invalide ou expiré.');
        return $this->redirectToRoute('app_lost_password');
       }

       $form = $this->createForm(ResetPasswordType::class);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
        $password = $form->get('plainPassword')->getData();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user->setPassword($hashedPassword);
        $user->setResetToken(null);
        $user->setResetTokenExpiresAt(null);

        $entityManager->flush();

        $this->addFlash('success', 'Votre mot de passe a été mis à jour avec succès !!');
        return $this->redirectToRoute('app_login');
       }
    

        return $this->render('reset_password/reset_password.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }
}
