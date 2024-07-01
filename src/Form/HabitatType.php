<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Habitat;
use App\Entity\Ville;
use App\Entity\Option;
use App\Entity\Quantity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class HabitatType extends AbstractType
{
    
public function __construct(private FormListenerFactory $Listenerfactory) {
    
}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'empty_data' => ''
            ])

            ->add('address', TextareaType::class, [
                'label' => 'Adresse',
                'empty_data' => ''
            ])


            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => function ($ville) {
                    return $ville->getName() . ' (' . $ville->getPays() . ')';
                },
                // 'expanded' => true
            ])

            ->add('slug', TextType::class,
            [ 'required' => false,
            ])

            ->add('category', EntityType::class, [ 
                'class' => Category::class,
                'choice_label' => 'name',
            // 'expanded' => true
            ])

            

            // ->add('options', EntityType::class, [
            //     'class' => Option::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     'expanded' => true,
            // ])
            

            // ->add('category', EntityType::class, [
            //     'class' => Category::class,
            //     'choice_label' => function ($category) {
            //         return $category->getName() . ' (' . $category->getSlug() . ')';
            //     },
            //     // 'expanded' => true
            // ])

            

            // ->add('ville', EntityType::class, [ 
            //     'class' => Ville::class,
            //     'choice_label' => 'name',
            // // 'expanded' => true
            // ])
            
            
            
            ->add('content', TextareaType::class, [
                'empty_data' => ''
            ])
            ->add('capacity', TextareaType::class, [
                'empty_data' => ''
            ])
            ->add('nombreDeCouchage')
            ->add('price', TextType::class, [
                'empty_data' => ''
            ])
            ->add('en_vente')
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updatedAt', null, [
            //     'widget' => 'single_text',
            // ])

            ->add('thumbnailFile', FileType::class)


            ->add('quantities', CollectionType::class, [
                'entry_type' => QuantityType::class,
                'by_reference' => false,
                'allow_add' => true,
                // 'allow_delete' => true,
                // 'prototype' => true,
                'entry_options' => ['label' => false],
                'attr'=> ['data-controller' => 'form-collection',
]
                
            ]) 
            
            ->add('save', SubmitType::class,[
                'label' => 'Envoyer'
                ])
            // ->add('quantities', CollectionType::class, [
            //         'entry_type' => QuantityType::class,
            //         'by_reference' => false,
            //         'allow_add' => true,
            //         'allow_delete' => true,
            //         'prototype' => true,
            //         'entry_options' => ['label' => false],
            //     ])
                
            ->addEventListener(FormEvents::PRE_SUBMIT, $this->Listenerfactory->autoSlug('title'))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->Listenerfactory->timestamps())

            ;
    } 


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Habitat::class,
        ]);
    }

    // public function autoSlug(PreSubmitEvent $event): void
    // {
    //     $data = $event->getData();

    //     if(empty($data['slug'])){

    //         $slugger = new AsciiSlugger();
    //         $data['slug'] = strtoLower($slugger->slug($data['title']));
    //         $event->setData($data);
    //     }

    // }

    // public function attachTimestamps(PostSubmitEvent $event):void
    // {
    //     $data = $event->getData();
    //     if(!($data instanceof Habitat)){
    //             return;
    //     }

    //     $data->setUpdatedAt(new \DateTimeImmutable());

    //     if(!$data->getId()){
    //         $data->setCreatedAt(new \DateTimeImmutable());
    //     }



    // }
}