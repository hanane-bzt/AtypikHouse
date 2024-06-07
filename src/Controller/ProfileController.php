<?php

// src/Controller/ProfileController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="user_profile")
     */
    public function index(TokenStorageInterface $tokenStorage): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $tokenStorage->getToken()->getUser();
        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            throw $this->createAccessDeniedException('You must be logged in to access this page.');
        }

        // Rendre le template du profil avec les informations de l'utilisateur
        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}
