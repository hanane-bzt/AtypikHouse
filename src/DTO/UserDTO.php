<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 180)]
    public string $username;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public string $password;

    #[Assert\Type("array")]
    public array $roles = [];

    #[Assert\Type("boolean")]
    public bool $isVerified = false;

    #[Assert\Type("integer")]
    public ?int $profileId = null;
}