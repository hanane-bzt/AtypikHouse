<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use App\Entity\User;
use App\Form\HabitatType;
use App\Repository\CategoryRepository;
use App\Repository\HabitatRepository;
use App\Security\Voter\HabitaVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route("/admin/habitats", name: 'admin.habitat.')]
class HabitaController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[IsGranted(HabitaVoter::LIST)] 
      public function index(HabitatRepository $repository,Request $request, Security $security): Response
     {  
        // $habitats = $repository->findWithPriceLowerThan(3000); 
        $page = $request->query->getInt('page', 1);
        // $limit=2;
        // $habitats = $repository->paginateHabitat($page, $limit);
        $userId = $security->getUser()->getId(); 
        $canListAll = $security->isGranted (HabitaVoter :: LIST_ALL);
        $habitats = $repository->paginateHabitats ($page, $canListAll ? null: $userId);
        // $habitats = $repository->paginateHabitat($page); 
        // $maxPage = ceil($habitats->count() / $limit);

        
        
                 return $this->render('admin/habita/index.html.twig', [
             'habitats' => $habitats,
            // 'maxPage'  => $maxPage,
            // 'page' => $page
        ]);
    }
    
    // #[Route('/{slug}-{id}', name: 'habitat.show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+' ])]
    // public function show(Request $request, string $slug, int $id, HabitatRepository $repository): Response
    //  {
    //     $habitat=$repository->find($id);

    //     if ($habitat->getSlug() != $slug) {

    //         return $this->redirectToRoute('habitat.show', [ 'slug' => $habitat->getSlug(),'id' => $habitat->getId()]);
    //     }

    //     return $this->render('habita/show.html.twig', [
    //         'habitat' => $habitat
    //     ]);
       
    // }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    #[IsGranted(HabitaVoter::EDIT, subject:'habitat')] 
    public function edit(Habitat $habitat, Request $request, EntityManagerInterface $em, UploaderHelper $Help){

       $form = $this->createForm(HabitatType::class, $habitat);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()) {
      
 
         $em->flush();
         $this->addFlash('success', "L' habitat a été bien modifiée");
        return $this->redirectToRoute('admin.habitat.index');
       }

        return $this->render('admin/habita/edit.html.twig', [
            'habitat'=>$habitat,
            'form'=>$form
        ]);
    }

    #[Route('/create', name: 'create')]
    #[IsGranted(HabitaVoter::CREATE)] 
    public function create(Request $request, EntityManagerInterface $em)
    {
       $habitat = new Habitat(); 
       $form = $this->createForm(HabitatType::class, $habitat);
       $form->handleRequest($request); 
       if($form->isSubmitted() && $form->isValid()) {

        $habitat->setUser($this->getUser()); 
        //$habitat->setCreatedAt(new \DateTimeImmutable());
       // $habitat->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($habitat);
        $em->flush();
        $this->addFlash('success', "L' habitat a été bien créée");
        return $this->redirectToRoute('admin.habitat.index'); 
       }
        return $this->render('admin/habita/create.html.twig', [
            'form'=>$form
        ]);
    }


    #[Route('/{id}', name: 'delete', methods:['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    #[IsGranted(HabitaVoter::EDIT, subject:'habitat')] 
    public function remove(Habitat $habitat, EntityManagerInterface $em)
    {
        $em->remove($habitat);
        $em->flush();
        $this->addFlash('success', "L' habitat a  bien été suppriméée");
        return $this->redirectToRoute('admin.habitat.index');
       }
      
    }
    

