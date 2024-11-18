<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Models;

class Product
{
    /**
     * Constructs a new Product instance.
     *
     * @param string $code The unique code identifying the product.
     * @param string $name The name of the product.
     * @param float $price The price of the product.
     */
    public function __construct(
        public string $code,
        public string $name,
        public float $price
    ) {}
}
