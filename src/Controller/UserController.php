<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

class UserController extends AbstractController
{
    
    
    /**
     * @Route("/users", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        return new JsonResponse(['message' => 'liste des users à venir.'], Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @Route("/users", name="user_create", methods={"POST"})
     */
    public function createUser(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        // Récupérer les données de la requête
        $userData = json_decode($request->getContent(), true);

        // Créer une nouvelle instance d'utilisateur
        $user = new User();
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);
        $user->setName($userData['nom']);

        // Enregistrer l'utilisateur dans la base de données
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Utilisateur créé avec succès', Response::HTTP_CREATED);
    }

    /**
     * @Route("/users/{id}", name="user_read", methods={"GET"})
     */
    public function readUser(int $id): JsonResponse
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }   

        return new JsonResponse($user);
    }

    /**
     * @Route("/users/{id}", name="user_update", methods={"PUT"})
     */
    public function updateUser(Request $request, int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $userData = json_decode($request->getContent(), true);

        // Mettre à jour les champs de l'utilisateur
        $user->setName($userData['name']);
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);

        // Enregistrer les changements dans la base de données
        $entityManager->flush();

        return new JsonResponse(['message' => 'Utilisateur mis à jour avec succès']);
    }

    /**
     * @Route("/users/{id}", name="user_delete", methods={"DELETE"})
     */
    public function deleteUser(int $id): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        // Supprimer l'utilisateur de la base de données
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Utilisateur supprimé avec succès']);
    }



}
