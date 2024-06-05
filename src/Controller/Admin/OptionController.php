<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/option", name: 'admin.option.')]
#[IsGranted('ROLE_ADMIN')]
class OptionController extends AbstractController {

    
    #[Route(name: 'index')]
    public function index(OptionsRepository $repository){
        return $this->render('admin/option/index.html.twig', [
            'options' => $repository->findAll()
        ]);
    }

    #[Route("/create", name: 'create')]
    public function create(Request $request, EntityManagerInterface $em){
        $option = new Option();
        $form = $this->createForm(OptionType::class,$option);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($option);
            $em->flush();
            $this->addFlash('success', "La option a bien été  créée");
            return $this->redirectToRoute('admin.option.index');
          
        }

        return $this->render('admin/option/create.html.twig', [
            'form'=>$form
        ]);

    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Option $option, Request $request, EntityManagerInterface $em){

        $form = $this->createForm(OptionType::class,$option);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', "L'option a bien été modifiée");
            return $this->redirectToRoute('admin.option.index');
         
        }

        return $this->render('admin/option/edit.html.twig', [
            'option'=>$option,
            'form'=>$form
        ]);
        
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function remove(Option $option, EntityManagerInterface $em)
    {
        $em->remove($option);
        $em->flush();
        $this->addFlash('success', "L'option bien été  suppriméée");
        return $this->redirectToRoute('admin.option.index');
        // if ($request->isMethod('DELETE')) {
        //     $em->remove($option);
        //     $em->flush();
        //     $this->addFlash('success', "La catégorie a bien été supprimée");
        //     return $this->redirectToRoute('admin.option.index');
        // }
       }

    
    
      
    }

