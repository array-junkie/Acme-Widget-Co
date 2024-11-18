<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Basket\Offer;

interface OfferInterface
{
    public function apply(array $products, float $subtotal): float;
}
