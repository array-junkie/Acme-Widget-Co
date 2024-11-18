<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Basket\Offer;

use AliEhsan\AcmeApp\Models\Product;

class BuyOneGetHalfOffStrategy implements OfferInterface
{
    public function __construct(private string $productCode) {}

    public function apply(array $products, float $subtotal): float
    {
        $eligibleProducts = array_values(array_filter($products, fn(Product $product) => $product->code === $this->productCode));

        $discounts = intdiv(count($eligibleProducts), 2) * (count($eligibleProducts) > 0 ? ($eligibleProducts[0]->price / 2) : 1);

        return $subtotal - $discounts;
    }
}
