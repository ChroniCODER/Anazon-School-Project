<?php

namespace App\Twig\Runtime;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Twig\Extension\RuntimeExtensionInterface;

class ProductExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(private ProductRepository $productRepository)
    {
        // Inject dependencies if needed
    }

    public function getProductById(int $productId):?Product
    {
        return $this->productRepository->find($productId);
    }
}
