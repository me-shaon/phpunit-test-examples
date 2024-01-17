<?php

namespace App;

class ShoppingCart
{
    public array $products = [];
    private int $subTotal = 0;
    private int $discount = 0;

    public function __construct(protected OrderService $orderService)
    {
    }

    public function addProduct(Product $product)
    {
        $found = false;
        foreach ($this->products as $existingProduct) {
            if ($existingProduct->getId() === $product->getId()) {
                $existingProduct->increaseQuantity();
                $found = true;
                break;
            }
        }

        if (!$found) {
            $this->products[] = $product;
        }

        $this->subTotal += $product->getPrice();
    }

    public function removeProduct(Product $product): void
    {
        foreach ($this->products as $key => $existingProduct) {
            if ($existingProduct->getId() === $product->getId()) {
                if ($product->getQuantity() === 1) {
                    unset($this->products[$key]);
                } else {
                    $product->decreaseQuantity();
                }
            }
        }

        $this->products = array_values($this->products);

        $this->subTotal -= $product->getPrice();
    }

    public function getTotal(): int
    {
        return $this->subTotal;
    }

    public function getTotalQuantity()
    {
        $totalQuantity = 0;

        foreach ($this->products as $product) {
            $totalQuantity += $product->getQuantity();
        }

        return $totalQuantity;
    }

    public function applyDiscount(int $discount)
    {
        if ($discount < 0 || $discount > $this->subTotal) {
            return;
        }

        $this->subTotal -= $discount;
    }

    public function makeOrder()
    {
        $productIds = array_map(
            fn (Product $product) => $product->getId(),
            $this->products
        );

        $this->orderService->order($productIds);
    }
}