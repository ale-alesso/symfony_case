<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    #[Route('/product/{id}', name: 'get_product', methods: ['GET'])]
    public function getProduct(int $id): JsonResponse
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            return new JsonResponse(['error' => 'Product not found'], 404);
        }

        return new JsonResponse($product);
    }

    #[Route('/product', name: 'create_product', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        // todo create product
    }

    #[Route('/product/search', name: 'search_product', methods: ['GET'])]
    public function searchProduct(Request $request): JsonResponse
    {
        $name = $request->query->get('name');
        $products = $this->productRepository->findByName($name);

        return new JsonResponse($products);
    }

    #[Route('/product/price-range', name: 'product_price_range', methods: ['GET'])]
    public function productPriceRange(Request $request): JsonResponse
    {
        $minPrice = (float) $request->query->get('min');
        $maxPrice = (float) $request->query->get('max');
        $products = $this->productRepository->findByPriceRange($minPrice, $maxPrice);

        return new JsonResponse($products);
    }

    #[Route('/product/more-expensive-than', name: 'product_more_expensive_than', methods: ['GET'])]
    public function productMoreExpensiveThan(Request $request): JsonResponse
    {
        $price = (float) $request->query->get('price');
        $products = $this->productRepository->findMoreExpensiveThan($price);

        return new JsonResponse($products);
    }
}
