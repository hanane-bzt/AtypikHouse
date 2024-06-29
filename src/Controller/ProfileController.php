<?php
// src/Controller/ProfileController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('You are not logged in.');
        }

        return $this->render('profile/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
