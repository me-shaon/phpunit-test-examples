<?php

namespace Tests;

use App\OrderService;
use App\Product;
use App\ShoppingCart;
use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    private ShoppingCart $cart;

    protected function setUp(): void
    {
        $orderServiceMock = $this->createMock(OrderService::class);
        $this->cart = new ShoppingCart($orderServiceMock);
    }

    public function test_empty_cart()
    {
        $this->assertCount(0, $this->cart->products);
        $this->assertSame(0, $this->cart->getTotal());
    }

    public function test_add_product_to_cart()
    {
        // Arrange
        $product = new Product(1, 100);

        // Act
        $this->cart->addProduct($product);

        // Assert
        $this->assertCount(1, $this->cart->products);
        $this->assertSame(100, $this->cart->getTotal());
    }

    public function test_add_multiple_products_to_cart()
    {
        // Arrange
        $product1 = new Product(1, 100);
        $product2 = new Product(2, 50);
        $product3 = new Product(3, 25);

        // Act
        $this->cart->addProduct($product1);
        $this->cart->addProduct($product2);
        $this->cart->addProduct($product3);

        // Assert
        $this->assertCount(3, $this->cart->products);
        $this->assertSame(3, $this->cart->getTotalQuantity());
        $this->assertSame(175, $this->cart->getTotal());
    }

    public function test_add_same_product_multiple_times_to_cart()
    {
        // Arrange
        $product = new Product(1, 100);

        // Act
        $this->cart->addProduct($product);
        $this->cart->addProduct($product);
        $this->cart->addProduct($product);

        // Assert
        $this->assertCount(1, $this->cart->products);
        $this->assertSame(3, $this->cart->getTotalQuantity());
    }

    public function test_remove_from_cart()
    {
        // Arrange
        $product1 = new Product(1, 100);
        $product2 = new Product(2, 50);
        $product3 = new Product(3, 25);

        // Act
        $this->cart->addProduct($product1);
        $this->cart->addProduct($product2);
        $this->cart->addProduct($product3);

        $this->cart->removeProduct($product2);

        // Assert
        $this->assertCount(2, $this->cart->products);
        $this->assertSame(2, $this->cart->getTotalQuantity());
        $this->assertSame(125, $this->cart->getTotal());
    }

    public function test_remove_one_instance_of_a_product_having_multiple_quantity()
    {
        // Arrange
        $product = new Product(1, 100);

        // Act
        $this->cart->addProduct($product);
        $this->cart->addProduct($product);
        $this->cart->addProduct($product);

        $this->cart->removeProduct($product);

        // Assert
        $this->assertCount(1, $this->cart->products);
        $this->assertSame(2, $this->cart->getTotalQuantity());
        $this->assertSame(200, $this->cart->getTotal());
    }

    public function test_remove_all_instances_of_a_product_having_multiple_quantity()
    {
        // Arrange
        $product = new Product(1, 100);

        // Act
        $this->cart->addProduct($product);
        $this->cart->addProduct($product);
        $this->cart->addProduct($product);

        $this->cart->removeProduct($product);
        $this->cart->removeProduct($product);
        $this->cart->removeProduct($product);

        // Assert
        $this->assertCount(0, $this->cart->products);
        $this->assertSame(0, $this->cart->getTotalQuantity());
        $this->assertSame(0, $this->cart->getTotal());
    }

    public function test_add_discount_works()
    {
        // Arrange
        $product1 = new Product(1, 100);
        $product2 = new Product(2, 50);
        $product3 = new Product(3, 25);

        // Act
        $this->cart->addProduct($product1);
        $this->cart->addProduct($product2);
        $this->cart->addProduct($product3);

        $this->cart->applyDiscount(10);

        // Assert
        $this->assertSame(165, $this->cart->getTotal());
    }

    public function test_negative_discount_should_not_work()
    {
        // Arrange
        $product1 = new Product(1, 100);
        $product2 = new Product(2, 50);
        $product3 = new Product(3, 25);

        // Act
        $this->cart->addProduct($product1);
        $this->cart->addProduct($product2);
        $this->cart->addProduct($product3);

        $this->cart->applyDiscount(-10);

        // Assert
        $this->assertSame(175, $this->cart->getTotal());
    }

    public function test_discount_more_than_total_should_not_work()
    {
        // Arrange
        $product1 = new Product(1, 100);
        $product2 = new Product(2, 50);
        $product3 = new Product(3, 25);

        // Act
        $this->cart->addProduct($product1);
        $this->cart->addProduct($product2);
        $this->cart->addProduct($product3);

        $this->cart->applyDiscount(185);

        // Assert
        $this->assertSame(175, $this->cart->getTotal());
    }

    public function test_make_order_is_working()
    {
        $orderServiceMock = $this->createMock(OrderService::class);

        $cart = new ShoppingCart($orderServiceMock);

        $product1 = new Product(1, 100);
        $product2 = new Product(2, 100);
        $cart->addProduct($product1);
        $cart->addProduct($product2);

        // Mock
        $orderServiceMock
            ->expects($this->once())
            ->method('order')
            ->with([1, 2]);

        $orderId = $cart->makeOrder();
    }
}