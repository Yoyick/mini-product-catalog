<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Annotation\Groups;

class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    public function index(Request $request, ProductService $productService): JsonResponse
    {
        // Query params ophalen
        $minPrice = (float) $request->query->get('minPrice', 0);
        $minStock = (int) $request->query->get('minStock', 0);
        $search = (string) $request->query->get('search', '');
        
        $products = $productService->getAllProducts($minPrice, $minStock, $search);

        return $this->json($products);
    }
}
