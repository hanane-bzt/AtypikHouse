<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\Profile;
use App\DTO\UserDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api/user', name: 'api_user_')]
class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $users = $this->entityManager
            ->getRepository(User::class)
            ->findAll();

        $data = array_map(fn(user $user) => [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role'=>$user->getRoles(),
            'isVerified'=>$user->isVerified(),



        ], $users);

        return $this->json($data);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(#[MapRequestPayload] UserDTO $userDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($userDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $user = new User();
        $user->setUsername($userDTO->username);
        $user->setEmail($userDTO->email);
        $user->setRoles($userDTO->roles);
        $user->setIsVerified($userDTO->isVerified);

        // Hash the password
        $hashedPassword = $this->passwordHasher->hashPassword($user, $userDTO->password);
        $user->setPassword($hashedPassword);

        if ($userDTO->profileId) {
            $profile = $this->entityManager->getRepository(Profile::class)->find($userDTO->profileId);
            if (!$profile) {
                return $this->json(['message' => 'Profile not found'], 400);
            }
            $user->setProfile($profile);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json($user, 201, [], ['groups' => 'user:read']);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        return $this->json($user, 200, [], ['groups' => 'user:read']);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] UserDTO $userDTO, ValidatorInterface $validator): JsonResponse
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $errors = $validator->validate($userDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $user->setUsername($userDTO->username);
        $user->setEmail($userDTO->email);
        $user->setRoles($userDTO->roles);
        $user->setIsVerified($userDTO->isVerified);

        if ($userDTO->password) {
            $hashedPassword = $this->passwordHasher->hashPassword($user, $userDTO->password);
            $user->setPassword($hashedPassword);
        }

        if ($userDTO->profileId) {
            $profile = $this->entityManager->getRepository(Profile::class)->find($userDTO->profileId);
            if (!$profile) {
                return $this->json(['message' => 'Profile not found'], 400);
            }
            $user->setProfile($profile);
        }

        $this->entityManager->flush();

        return $this->json($user, 200, [], ['groups' => 'user:read']);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
}