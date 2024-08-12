<?php
namespace App\Controller\API;

use App\DTO\HabitatDTO as DTOHabitatDTO;
use App\DTO\PaginationDTO;
use App\Entity\Habitat;
use App\Entity\HabitatDTO;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/habitats', name: 'api_habitats_')]
class HabitatController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(Request $request, HabitatRepository $repository): JsonResponse
    {
        $page = $request->query->getInt('page', 1); // Récupère la page de la requête, par défaut 1
        $userId = $request->query->get('userId'); // Récupère l'userId s'il est fourni

        $habitats = $repository->paginateHabitats($page, $userId);

        return $this->json($habitats, 200, [], [
            'groups' => ['habitats.index']
        ]);
    }

    #[Route('/{id}',name: 'show',requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function show(Habitat $habitat)
    {
        if (!$habitat) {
            throw new NotFoundHttpException('Habitat not found');
        }

        return $this->json($habitat, 200, [], [
            'groups' => ['habitats.index', 'habitats.show']
        ]);
    }

    
    #[Route("",name: "create" ,methods: ['POST'])]
    public function create(
        Request $request,
        #[MapRequestPayload (
        serializationContext: [
        'groups'=>['habitats.create']
        ]
        )]
        Habitat $habitat,EntityManagerInterface $em
        ) 
    {
        // $habitat = new Habitat();
        $habitat->setCreatedAt(new \DateTimeImmutable());
        $habitat->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($habitat);
        $em->flush();
        return $this->json ($habitat, 200, [], [
        'groups'=>['habitats.index', 'habitats.show']
        ]);
    }


    /*#[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] HabitatDTO $habitatDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($habitatDTO);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $habitat = $this->entityManager->getRepository(Habitat::class)->find($id);
        if (!$habitat) {
            return $this->json('No habitat found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }*/
}




/*
namespace App\Controller\API;

use App\Entity\Habitat;
use App\Entity\Category;
use App\Entity\Ville;
use App\Entity\User;
use App\DTO\HabitatDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/habitat', name: 'api_habitat_')]
class HabitatController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $habitats = $this->entityManager->getRepository(Habitat::class)->findAll();

        $data = array_map(fn(Habitat $habitat) => [
            'id' => $habitat->getId(),
            'title' => $habitat->getTitle(),
            'address' => $habitat->getAddress(),
            'slug' => $habitat->getSlug(),
            'content' => $habitat->getContent(),
            'capacity' => $habitat->getCapacity(),
            'nombre_de_couchage' => $habitat->getNombreDeCouchage(),
            'price' => $habitat->getPrice(),
            'file' => $habitat->getFile(),
            'en_vente' => $habitat->isEnVente(),
            'category_id' => $habitat->getCategory()?->getId(),
            'ville_id' => $habitat->getVille()?->getId(),
            'user_id' => $habitat->getUser()?->getId(),
        ], $habitats);

        return $this->json($data);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(#[MapRequestPayload] HabitatDTO $habitatDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($habitatDTO);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $habitat = new Habitat();
        $this->updateHabitatFromDTO($habitat, $habitatDTO);
        $habitat->setCreatedAt(new \DateTimeImmutable());
        $habitat->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->persist($habitat);
        $this->entityManager->flush();
        $this->entityManager->refresh($habitat);  

        return $this->json([
            'id' => $habitat->getId(),
            'title' => $habitat->getTitle(),
            'address' => $habitat->getAddress(),
            'slug' => $habitat->getSlug(),
            'content' => $habitat->getContent(),
            'capacity' => $habitat->getCapacity(),
            'nombre_de_couchage' => $habitat->getNombreDeCouchage(),
            'price' => $habitat->getPrice(),
            'file' => $habitat->getFile(),
            'en_vente' => $habitat->isEnVente(),
            'category_id' => $habitat->getCategory()?->getId(),
            'ville_id' => $habitat->getVille()?->getId(),
            'user_id' => $habitat->getUser()?->getId(),
        ], JsonResponse::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $habitat = $this->entityManager->getRepository(Habitat::class)->find($id);
        if (!$habitat) {
            return $this->json('No habitat found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json($this->getHabitatData($habitat));
    }

    #[Route('/{id}', name: 'update', methods: ['PUT', 'PATCH'])]
    public function update(int $id, #[MapRequestPayload] HabitatDTO $habitatDTO, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($habitatDTO);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], JsonResponse::HTTP_BAD_REQUEST);
        }

        $habitat = $this->entityManager->getRepository(Habitat::class)->find($id);
        if (!$habitat) {
            return $this->json('No habitat found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        $this->updateHabitatFromDTO($habitat, $habitatDTO);
        $habitat->setUpdatedAt(new \DateTimeImmutable());

        $this->entityManager->flush();

        return $this->json($this->getHabitatData($habitat));
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $habitat = $this->entityManager->getRepository(Habitat::class)->find($id);
        if (!$habitat) {
            return $this->json('No habitat found for id ' . $id, JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($habitat);
        $this->entityManager->flush();

        return $this->json(null, JsonResponse::HTTP_NO_CONTENT);
    }

    private function updateHabitatFromDTO(Habitat $habitat, HabitatDTO $habitatDTO): void
    {
        $habitat->setTitle($habitatDTO->title);
        $habitat->setAddress($habitatDTO->address);
        $habitat->setSlug($habitatDTO->slug);
        $habitat->setContent($habitatDTO->content);
        $habitat->setCapacity($habitatDTO->capacity);
        $habitat->setNombreDeCouchage($habitatDTO->nombreDeCouchage);
        $habitat->setPrice($habitatDTO->price);
        $habitat->setFile($habitatDTO->file);
        $habitat->setEnVente($habitatDTO->enVente);

      
        if (isset($habitatDTO->categoryId)) {
            $category = $this->entityManager->getRepository(Category::class)->find($habitatDTO->categoryId);
            if ($category) {
                $habitat->setCategory($category);
            }
        }
    
        if (isset($habitatDTO->villeId)) {
            $ville = $this->entityManager->getRepository(Ville::class)->find($habitatDTO->villeId);
            if ($ville) {
                $habitat->setVille($ville);           
             }
           
          
        }
    
        if (isset($habitatDTO->userId)) {
            $user = $this->entityManager->getRepository(User::class)->find($habitatDTO->userId);
            if ($user) {
                $habitat->setUser($user);
            }
            
         
        }
    }

    private function getHabitatData(Habitat $habitat): array
    {
        return [
            'id' => $habitat->getId(),
            'title' => $habitat->getTitle(),
            'address' => $habitat->getAddress(),
            'slug' => $habitat->getSlug(),
            'content' => $habitat->getContent(),
            'capacity' => $habitat->getCapacity(),
            'nombre_de_couchage' => $habitat->getNombreDeCouchage(),
            'price' => $habitat->getPrice(),
            'file' => $habitat->getFile(),
            'en_vente' => $habitat->isEnVente(),
            'category_id' => $habitat->getCategory()?->getId(),
            'ville_id' => $habitat->getVille()?->getId(),
            'user_id' => $habitat->getUser()?->getId(),
        ];
    }
}

*/
