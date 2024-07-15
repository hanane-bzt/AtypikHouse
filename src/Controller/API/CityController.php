<?php

namespace App\Controller\API;

use App\Entity\Ville;
use App\Entity\Pays;
use App\DTO\CityDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/ville', name: 'api_ville_')]
class CityController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $villes = $this->entityManager->getRepository(Ville::class)->findAll();
        return $this->json($villes);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(#[MapRequestPayload] CityDTO $CityDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($CityDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $ville = new Ville();
        $ville->setName($CityDTO->name);
        $ville->setSlug($CityDTO->slug);
        $ville->setLatitude($CityDTO->latitude);
        $ville->setLongitude($CityDTO->longitude);
        $ville->setCreatedAt(new \DateTimeImmutable());
        $ville->setUpdatedAt(new \DateTimeImmutable());

        $pays = $this->entityManager->getRepository(Pays::class)->find($CityDTO->paysId);
        if (!$pays) {
            return $this->json(['message' => 'Pays not found'], 400);
        }
        $ville->setPays($pays);

        $this->entityManager->persist($ville);
        $this->entityManager->flush();

        return $this->json($ville, 201);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $ville = $this->entityManager->getRepository(Ville::class)->find($id);
        if (!$ville) {
            return $this->json(['message' => 'Ville not found'], 404);
        }
        return $this->json($ville);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] CityDTO $CityDTO, ValidatorInterface $validator): JsonResponse
    {
        $ville = $this->entityManager->getRepository(Ville::class)->find($id);
        if (!$ville) {
            return $this->json(['message' => 'Ville not found'], 404);
        }

        $errors = $validator->validate($CityDTO);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $ville->setName($CityDTO->name);
        $ville->setSlug($CityDTO->slug);
        $ville->setLatitude($CityDTO->latitude);
        $ville->setLongitude($CityDTO->longitude);
        $ville->setUpdatedAt(new \DateTimeImmutable());

        $pays = $this->entityManager->getRepository(Pays::class)->find($CityDTO->paysId);
        if (!$pays) {
            return $this->json(['message' => 'Pays not found'], 400);
        }
        $ville->setPays($pays);

        $this->entityManager->flush();

        return $this->json($ville);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $ville = $this->entityManager->getRepository(Ville::class)->find($id);
        if (!$ville) {
            return $this->json(['message' => 'Ville not found'], 404);
        }

        $this->entityManager->remove($ville);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
}