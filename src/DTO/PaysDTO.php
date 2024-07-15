<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class PaysDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    public string $code;
}