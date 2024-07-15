<?php

namespace App\Controller\API;

use App\Entity\Option;
use App\DTO\OptionDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/option', name: 'api_option_')]
class OptionController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $options = $this->entityManager->getRepository(Option::class)->findAll();
        return $this->json($options);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(#[MapRequestPayload] OptionDTO $optionDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($optionDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $option = new Option();
        $option->setName($optionDTO->name);
        $option->setSlug($optionDTO->slug);
        $option->setCreatedAt(new \DateTimeImmutable());
        $option->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($option);
        $this->entityManager->flush();

        return $this->json($option, 201);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $option = $this->entityManager->getRepository(Option::class)->find($id);
        if (!$option) {
            return $this->json(['message' => 'Option not found'], 404);
        }
        return $this->json($option);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] OptionDTO $optionDTO, ValidatorInterface $validator): JsonResponse
    {
        $option = $this->entityManager->getRepository(Option::class)->find($id);
        if (!$option) {
            return $this->json(['message' => 'Option not found'], 404);
        }

        $errors = $validator->validate($optionDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $option->setName($optionDTO->name);
        $option->setSlug($optionDTO->slug);
        $option->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->flush();

        return $this->json($option);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $option = $this->entityManager->getRepository(Option::class)->find($id);
        if (!$option) {
            return $this->json(['message' => 'Option not found'], 404);
        }

        $this->entityManager->remove($option);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
}