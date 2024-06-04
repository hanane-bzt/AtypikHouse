<?php

namespace App\Controller\Admin;

use App\Entity\Ville;
use App\Form\CityType;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/city", name: 'admin.city.')]
#[IsGranted('ROLE_ADMIN')]
class CityController extends AbstractController {

    
    #[Route(name: 'index')]
    public function index(CityRepository $repository){
        return $this->render('admin/city/index.html.twig', [
            'cities' => $repository->findAll()
        ]);
    }

    #[Route("/create", name: 'create')]
    public function create(Request $request, EntityManagerInterface $em){
        $city= new Ville();
        $form = $this->createForm(CityType::class,$city);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($city);
            $em->flush();
            $this->addFlash('success', "La catégorie a bien été  créée");
            return $this->redirectToRoute('admin.city.index');
          
        }

        return $this->render('admin/city/create.html.twig', [
            'form'=>$form
        ]);

    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Ville $city, Request $request, EntityManagerInterface $em){

        $form = $this->createForm(CityType::class,$city);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', "La catégorie a bien été modifiée");
            return $this->redirectToRoute('admin.city.index');
         
        }

        return $this->render('admin/city/edit.html.twig', [
            'city'=>$city,
            'form'=>$form
        ]);
        
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function remove(Ville $city, EntityManagerInterface $em)
    {
        $em->remove($city);
        $em->flush();
        $this->addFlash('success', "La catégorie bien été  suppriméée");
        return $this->redirectToRoute('admin.city.index');
        // if ($request->isMethod('DELETE')) {
        //     $em->remove($category);
        //     $em->flush();
        //     $this->addFlash('success', "La catégorie a bien été supprimée");
        //     return $this->redirectToRoute('admin.category.index');
        // }
       }

    
    
      
    }

