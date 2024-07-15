<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class QuantityDTO
{
    #[Assert\NotBlank]
    #[Assert\Type("numeric")]
    public float $quantity;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 255)]
    public string $unit;

    #[Assert\NotBlank]
    #[Assert\Type("integer")]
    public int $habitatId;

    #[Assert\NotBlank]
    #[Assert\Type("integer")]
    public int $optionId;
}