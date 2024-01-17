<?php

namespace App;

class Product
{
    public function __construct(
        private int $id,
        private int $price,
        private int $quantity = 1
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function increaseQuantity(): void
    {
        $this->quantity++;
    }

    public function decreaseQuantity(): void
    {
        $this->quantity--;
    }
}