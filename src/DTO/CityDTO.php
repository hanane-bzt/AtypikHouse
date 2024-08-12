<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CityDTO
{

    public ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $slug;

    #[Assert\NotBlank]
    #[Assert\Type("numeric")]
    public float $latitude;

    #[Assert\NotBlank]
    #[Assert\Type("numeric")]
    public float $longitude;

    #[Assert\NotBlank]
    #[Assert\Type("integer")]
    public int $paysId;
}