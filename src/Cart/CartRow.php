<?php

namespace App\Cart;

use App\Entity\Product;
use InvalidArgumentException;

class CartRow
{
    private int $productId;

    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->productId = $product->getId();
        $this->quantity = $quantity;
    }

    public function add(int $quantity): void
    {
        $this->quantity += $quantity;
    }

    public function remove(int $quantity): void
    {
        if($quantity > $this->quantity){
            throw new InvalidArgumentException('the quantity to remove is too high');
        }
        $this->quantity -= $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

        public function getProductId(): int
    {
        return $this->productId;
    }
}