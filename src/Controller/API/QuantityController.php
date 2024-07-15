<?php

namespace App\Controller\API;

use App\Entity\Quantity;
use App\Entity\Habitat;
use App\Entity\Option;
use App\DTO\QuantityDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/quantity', name: 'api_quantity_')]
class QuantityController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $quantities = $this->entityManager->getRepository(Quantity::class)->findAll();
        return $this->json($quantities);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(#[MapRequestPayload] QuantityDTO $quantityDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($quantityDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $quantity = new Quantity();
        $quantity->setQuantity($quantityDTO->quantity);
        $quantity->setUnit($quantityDTO->unit);

        $habitat = $this->entityManager->getRepository(Habitat::class)->find($quantityDTO->habitatId);
        if (!$habitat) {
            return $this->json(['message' => 'Habitat not found'], 400);
        }
        $quantity->setHabitat($habitat);

        $option = $this->entityManager->getRepository(Option::class)->find($quantityDTO->optionId);
        if (!$option) {
            return $this->json(['message' => 'Option not found'], 400);
        }
        $quantity->setOption($option);

        $this->entityManager->persist($quantity);
        $this->entityManager->flush();

        return $this->json($quantity, 201);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $quantity = $this->entityManager->getRepository(Quantity::class)->find($id);
        if (!$quantity) {
            return $this->json(['message' => 'Quantity not found'], 404);
        }
        return $this->json($quantity);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] QuantityDTO $quantityDTO, ValidatorInterface $validator): JsonResponse
    {
        $quantity = $this->entityManager->getRepository(Quantity::class)->find($id);
        if (!$quantity) {
            return $this->json(['message' => 'Quantity not found'], 404);
        }

        $errors = $validator->validate($quantityDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $quantity->setQuantity($quantityDTO->quantity);
        $quantity->setUnit($quantityDTO->unit);

        $habitat = $this->entityManager->getRepository(Habitat::class)->find($quantityDTO->habitatId);
        if (!$habitat) {
            return $this->json(['message' => 'Habitat not found'], 400);
        }
        $quantity->setHabitat($habitat);

        $option = $this->entityManager->getRepository(Option::class)->find($quantityDTO->optionId);
        if (!$option) {
            return $this->json(['message' => 'Option not found'], 400);
        }
        $quantity->setOption($option);

        $this->entityManager->flush();

        return $this->json($quantity);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $quantity = $this->entityManager->getRepository(Quantity::class)->find($id);
        if (!$quantity) {
            return $this->json(['message' => 'Quantity not found'], 404);
        }

        $this->entityManager->remove($quantity);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
}