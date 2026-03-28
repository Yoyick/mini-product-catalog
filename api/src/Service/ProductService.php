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

    public function getAllProducts(float $minPrice = 0, int $minStock = 0, string $search = ''): array
    {
        $qb = $this->productRepository->createQueryBuilder('p')
            ->where('p.price >= :minPrice')
            ->andWhere('p.stock >= :minStock')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('minStock', $minStock);

        if (trim($search) !== '') {
            $normalized = '%' . mb_strtolower(trim($search)) . '%';

            $qb->andWhere('LOWER(p.name) LIKE :search OR LOWER(p.description) LIKE :search')
               ->setParameter('search', $normalized);
        }

        $products = $qb->getQuery()->getResult();

        return array_map(fn($p) => new ProductDto(
            $p->getId(),
            $p->getName(),
            '€ ' . number_format($p->getPrice(), 2, ',', '.'),
            $p->getStock(),
            $p->getDescription() ?? 'Geen omschrijving'
        ), $products);
    }

}
