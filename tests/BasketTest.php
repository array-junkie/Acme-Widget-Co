<?php

declare(strict_types=1);

use AliEhsan\AcmeApp\Basket\Basket;
use AliEhsan\AcmeApp\Basket\DeliveryCost\DeliveryCostStrategy;
use AliEhsan\AcmeApp\Basket\Offer\BuyOneGetHalfOffStrategy;
use AliEhsan\AcmeApp\Exceptions\ProductNotFoundException;
use AliEhsan\AcmeApp\Models\Product;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private array $productCatalogue;
    private DeliveryCostStrategy $deliveryRule;

    protected function setUp(): void
    {
        $this->productCatalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];

        $this->deliveryRule = new DeliveryCostStrategy();
    }

    public function testEmptyBasket(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $this->assertEquals(0.0, $basket->total());
    }

    public function testSingleProduct(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('B01');
        $this->assertEquals(12.9, $basket->total()); // 7.95 + 4.95 delivery
    }

    public function testIfProductNotFoundInCatalogue(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('C01');
        $this->expectException(ProductNotFoundException::class);
    }

    public function testMultipleProductsNoDOffer(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total()); // 7.95 + 24.95 + 4.95 delivery
    }

    public function testOfferApplied(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.38, $basket->total()); // 32.95 + (32.95 / 2) + 4.95 delivery
    }

    public function testFreeDelivery(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(107.33, $basket->total()); // 32.95 + (32.95 / 2) + 24.95 + 0 delivery
    }

    public function testComplexBasket(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.28, $basket->total());
    }

    public function testOnly5RedWidget(): void
    {
        $basket = new Basket($this->productCatalogue, $this->deliveryRule, [new BuyOneGetHalfOffStrategy('R01')]);
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(131.80, $basket->total());
    }
}
