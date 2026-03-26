<?php

namespace App\Dto;

class ProductDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $priceFormatted,
        public readonly string $description,
    ) {}
}
