<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Basket;

use AliEhsan\AcmeApp\Basket\DeliveryCost\DeliveryCostStrategy;
use AliEhsan\AcmeApp\Exceptions\ProductNotFoundException;
use AliEhsan\AcmeApp\Models\Product;

class Basket implements BasketInterface
{
    private array $products = [];

    /**
     * Constructor
     *
     * @param array $productCatalogue An array of products that can be added to the basket.
     *     Each product should be an instance of ProductInterface.
     * @param DeliveryCostStrategy $deliveryCostStrategy
     * @param array $offers An array of offer instances to be applied after the delivery cost.
     *     Each offer should be an instance of OfferInterface.
     */
    public function __construct(
        private array $productCatalogue,
        private DeliveryCostStrategy $deliveryCostStrategy,
        private array $offers = []
    ) {}

    /**
     * Add a product to the basket.
     *
     * @param string $productCode The code identifying the product to be added.
     *     The product must exist in the catalogue provided in the constructor.
     *
     * @throws ProductNotFoundException Thrown if a product with the given code does not exist.
     */
    public function add(string $productCode): void
    {
        if (!isset($this->productCatalogue[$productCode])) {
            throw new ProductNotFoundException("Product with code $productCode does not exist.");
        }

        $this->products[] = $this->productCatalogue[$productCode];
    }

    /**
     * Calculates the total cost of the basket.
     *
     * This method first calculates the subtotal by summing up the prices of all products
     * in the basket. It then applies any offers to the subtotal to determine any discounts.
     * After applying offers, it calculates the delivery cost based on the updated subtotal
     * and adds it to the subtotal. The final total is returned.
     *
     * @return float The total cost of the basket including offers and delivery charges.
     */
    public function total(): float
    {
        $subtotal = array_reduce($this->products, fn(float $carry, Product $product) => $carry + $product->price, 0);

        foreach ($this->offers as $offer) {
            $subtotal = $offer->apply($this->products, $subtotal);
        }

        return round($subtotal + $this->deliveryCostStrategy->calculate($subtotal), 2);
    }
}
