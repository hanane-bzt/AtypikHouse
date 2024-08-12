<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class HabitatDTO
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $title;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $address;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $slug;

    #[Assert\NotBlank]
    #[Assert\Length(min: 15)]
    public string $content = '';

    #[Assert\NotBlank]
    #[Assert\Type('float')]
    public float $capacity;

    #[Assert\NotBlank]
    #[Assert\Type('float')]
    public float $price;

    #[Assert\Type('string')]
    public ?string $file=null;

    #[Assert\NotNull(message: "La valeur 'en vente' ne doit pas être nulle.")]
    #[Assert\Type('bool', message: "La valeur 'en vente' doit être un booléen.")]
    public ?bool $enVente=true;

    #[Assert\Type('int')]
    public ?int $categoryId=null;
    public ?CategoryDTO $category = null;

    #[Assert\Type('int')]
    public ?int $villeId=null;

    #[Assert\Type('int')]
    public ?int $userId=null;

    #[Assert\Type(type: 'int', message: "Le nombre de couchage doit être un nombre entier.")]
    #[Assert\PositiveOrZero(message: "Le nombre de couchage doit être un nombre positif ou zéro.")]
    public int $nombreDeCouchage;

    

   
}