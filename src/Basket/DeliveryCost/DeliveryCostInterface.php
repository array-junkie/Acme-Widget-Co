<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Basket\DeliveryCost;

interface DeliveryCostInterface
{
    public function calculate(float $subtotal): float;
}
