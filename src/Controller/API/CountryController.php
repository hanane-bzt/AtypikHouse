<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Entity\Pays;
use App\DTO\paysDTO;

#[Route('/api', name: 'api_')]
class CountryController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    #[Route('/pays', name: 'pays_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $categories = $this->entityManager
            ->getRepository(pays::class)
            ->findAll();

        $data = array_map(fn(pays $pays) => [
            'id' => $pays->getId(),
            'name' => $pays->getName(),
            'code' => $pays->getCode(),
        ], $categories);

        return $this->json($data);
    }

    #[Route('/pays', name: 'pays_create', methods: ['POST'])]
    public function create(#[MapRequestPayload] paysDTO $paysDTO): JsonResponse
    {
        $pays = new pays();
        $pays->setName($paysDTO->name);
        $pays->setCode($paysDTO->code);
        $pays->setCreatedAt(new \DateTimeImmutable());
        $pays->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($pays);
        $this->entityManager->flush();

        return $this->json([
            'id' => $pays->getId(),
            'name' => $pays->getName(),
            'code' => $pays->getCode(),
        ], JsonResponse::HTTP_CREATED);
    }

    #[Route('/pays/{id}', name: 'pays_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $pays = $this->entityManager->getRepository(pays::class)->find($id);
   
        if (!$pays) {
            return $this->json('No pays found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $pays->getId(),
            'name' => $pays->getName(),
            'code' => $pays->getCode(),
        ]);
    }

    #[Route('/pays/{id}', name: 'pays_update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] paysDTO $paysDTO): JsonResponse
    {
        $pays = $this->entityManager->getRepository(pays::class)->find($id);

        if (!$pays) {
            return $this->json('No pays found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        $pays->setName($paysDTO->name);
        $pays->setCode($paysDTO->code);
        $pays->setUpdatedAt(new \DateTimeImmutable());
        $this->entityManager->flush();

        return $this->json([
            'id' => $pays->getId(),
            'name' => $pays->getName(),
            'Code' => $pays->getCode(),
        ]);
    }

    #[Route('/pays/{id}', name: 'pays_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $pays = $this->entityManager->getRepository(pays::class)->find($id);

        if (!$pays) {
            return $this->json('No pays found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($pays);
        $this->entityManager->flush();

        return $this->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}




