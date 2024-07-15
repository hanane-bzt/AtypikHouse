<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Entity\Category;
use App\DTO\CategoryDTO;

#[Route('/api', name: 'api_')]
class CategoryController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    #[Route('/category', name: 'category_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $categories = $this->entityManager
            ->getRepository(Category::class)
            ->findAll();

        $data = array_map(fn(Category $category) => [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
        ], $categories);

        return $this->json($data);
    }

    #[Route('/category', name: 'category_create', methods: ['POST'])]
    public function create(#[MapRequestPayload] CategoryDTO $categoryDTO): JsonResponse
    {
        $category = new Category();
        $category->setName($categoryDTO->name);
        $category->setSlug($categoryDTO->slug);
        $category->setCreatedAt(new \DateTimeImmutable());
        $category->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $this->json([
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
        ], JsonResponse::HTTP_CREATED);
    }

    #[Route('/category/{id}', name: 'category_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $category = $this->entityManager->getRepository(Category::class)->find($id);
   
        if (!$category) {
            return $this->json('No category found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
        ]);
    }

    #[Route('/category/{id}', name: 'category_update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] CategoryDTO $categoryDTO): JsonResponse
    {
        $category = $this->entityManager->getRepository(Category::class)->find($id);

        if (!$category) {
            return $this->json('No category found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        $category->setName($categoryDTO->name);
        $category->setSlug($categoryDTO->slug);
        $category->setUpdatedAt(new \DateTimeImmutable());
        $this->entityManager->flush();

        return $this->json([
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
        ]);
    }

    #[Route('/category/{id}', name: 'category_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $category = $this->entityManager->getRepository(Category::class)->find($id);

        if (!$category) {
            return $this->json('No category found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        return $this->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}




/*
namespace App\Controller\API;

 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\Routing\Annotation\Route;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Component\HttpFoundation\Request;
 use App\Entity\Category;
  
  
 #[Route('/api', name: 'api_')]
 class CategoryController extends AbstractController
 {
     #[Route('/category', name: 'category_index', methods:['get'] )]
     public function index(EntityManagerInterface $entityManager): JsonResponse
     {
         
         $products = $entityManager
             ->getRepository(Category::class)
             ->findAll();
     
         $data = [];
     
         foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'slug' => $product->getSlug(),
            ];
         }
     
         return $this->json($data);
     }
   
   
     #[Route('/category', name: 'category_create', methods:['post'] )]
     public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
     {
         $category = new Category();
         $category->setName($request->request->get('name'));
         $category->setSlug($request->request->get('slug'));
         $category->setCreatedAt(new \DateTimeImmutable());
         $category->setUpdatedAt(new \DateTimeImmutable());
     
         $entityManager->persist($category);
         $entityManager->flush();
     
         $data =  [
             'id' => $category->getId(),
             'name' => $category->getName(),
             'slug' => $category->getSlug(),
         ];
             
         return $this->json($data);
     }
   
   
     #[Route('/category/{id}', name: 'category_show', methods:['get'] )]
     public function show(EntityManagerInterface $entityManager, int $id): JsonResponse
     {
         $category = $entityManager->getRepository(category::class)->find($id);
     
         if (!$category) {
     
             return $this->json('No category found for id ' . $id, 404);
         }
     
         $data =  [
             'id' => $category->getId(),
             'name' => $category->getName(),
             'slug' => $category->getslug(),
         ];
             
         return $this->json($data);
     }
   
     #[Route('/category/{id}', name: 'category_update', methods:['put', 'patch'] )]
     public function update(EntityManagerInterface $entityManager, Request $request, int $id): JsonResponse
     {
         $category = $entityManager->getRepository(Category::class)->find($id);
     
         if (!$category) {
             return $this->json('No category found for id ' . $id, 404);
         }
     
         $category->setName($request->request->get('name'));
         $category->setSlug($request->request->get('slug'));
         $entityManager->flush();
     
         $data =  [
             'id' => $category->getId(),
             'name' => $category->getName(),
             'slug' => $category->getSlug(),
         ];
             
         return $this->json($data);
     }
   
     #[Route('/category/{id}', name: 'category_delete', methods:['delete'] )]
     public function delete(EntityManagerInterface $entityManager, int $id): JsonResponse
     {
         $category = $entityManager->getRepository(category::class)->find($id);
     
         if (!$category) {
             return $this->json('No category found for id ' . $id, 404);
         }
     
         $entityManager->remove($category);
         $entityManager->flush();
     
         return $this->json('Deleted a category successfully with id ' . $id);
     }
 } 
 */

