<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    public function index(Request $request, ProductService $productService): JsonResponse
    {
        // Query param ophalen: ?minPrice=10
        $minPrice = (float) $request->query->get('minPrice', 0);
        
        $products = $productService->getAllProducts($minPrice);

        return $this->json($products);
    }
}
