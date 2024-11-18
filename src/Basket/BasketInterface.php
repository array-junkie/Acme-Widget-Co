<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Basket;

interface BasketInterface
{
    public function add(string $productCode): void;
    public function total(): float;
}
