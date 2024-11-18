<?php

declare(strict_types=1);

namespace AliEhsan\AcmeApp\Basket\DeliveryCost;

class DeliveryCostStrategy implements DeliveryCostInterface
{
    /**
     * Calculates the delivery cost based on the subtotal.
     *
     * @param float $subtotal The total cost of products in the basket.
     *
     * @return float The delivery cost.
     */
    public function calculate(float $subtotal): float
    {
        return match (true) {
            $subtotal >= 90 => 0.0,
            $subtotal >= 50 => 2.95,
            $subtotal > 0 => 4.95,
            default => 0
        };
    }
}
