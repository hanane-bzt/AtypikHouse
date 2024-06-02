<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/country", name: 'admin.country.')]
#[IsGranted('ROLE_ADMIN')]
class CountryController extends AbstractController {

    
    #[Route(name: 'index')]
    public function index(CountryRepository $repository){
        return $this->render('admin/country/index.html.twig', [
            'countries' => $repository->findAll()
        ]);
    }

    #[Route("/create", name: 'create')]
    public function create(Request $request, EntityManagerInterface $em){
        $country = new Pays();
        $form = $this->createForm(CountryType::class,$country);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($country);
            $em->flush();
            $this->addFlash('success', "Le pays a bien été  créé");
            return $this->redirectToRoute('admin.country.index');
          
        }

        return $this->render('admin/country/create.html.twig', [
            'form'=>$form
        ]);

    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Pays $country, Request $request, EntityManagerInterface $em){

        $form = $this->createForm(CountryType::class,$country);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', "Le pays a bien été modifié");
            return $this->redirectToRoute('admin.country.index');
         
        }

        return $this->render('admin/country/edit.html.twig', [
            'country'=>$country,
            'form'=>$form
        ]);
        
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function remove(Pays $country, EntityManagerInterface $em)
    {
        $em->remove($country);
        $em->flush();
        $this->addFlash('success', "Le pays a bien été  supprimé");
        return $this->redirectToRoute('admin.country.index');
        // if ($request->isMethod('DELETE')) {
        //     $em->remove($category);
        //     $em->flush();
        //     $this->addFlash('success', "La catégorie a bien été supprimée");
        //     return $this->redirectToRoute('admin.category.index');
        // }
       }

    
    
      
    }

