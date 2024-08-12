<?php

namespace App\DTO;

class CategoryDTO
{
    public int $id;

    public function __construct(
        public readonly string $name,
        public readonly string $slug
    ) {}
}