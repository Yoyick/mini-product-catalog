<?php

namespace App\Service;

use App\Repository\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        // Hier kun je later extra logica toevoegen, bijv. sortering of filtering
        return $this->productRepository->findAll();
    }
}
