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

    public function findByName(string $name)
    {
        return $this->productRepository->findByName($name);
    }

    public function findByPriceRange(float $minPrice, float $maxPrice)
    {
        return $this->productRepository->findByPriceRange($minPrice, $maxPrice);
    }
}
