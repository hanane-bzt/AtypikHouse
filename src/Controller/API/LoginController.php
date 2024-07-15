<?php
// src/Controller/UserController.php
namespace App\Controller\API;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;



class LoginController extends AbstractController
{

#[Route('/api/me')]
#[IsGranted("ROLE_USER")]
public function me()
{
return $this->json($this->getUser());
}
    
  
}