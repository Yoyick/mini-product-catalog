<?php

namespace App\Service;

use App\Repository\ProductRepository;
use App\Dto\ProductDto;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(float $minPrice = 0): array
    {        
        $products = $this->productRepository->createQueryBuilder('p')
            ->where('p.price > :minPrice')
            ->setParameter('minPrice', $minPrice)
            ->getQuery()
            ->getResult();

        return array_map(fn($p) => new ProductDto(
            $p->getId(),
            $p->getName(),
            '€ ' . number_format($p->getPrice(), 2, ',', '.'),
            $p->getDescription() ?? 'Geen omschrijving'
        ), $products);
    }

}
