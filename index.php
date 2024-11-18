<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use AliEhsan\AcmeApp\Basket\Basket;
use AliEhsan\AcmeApp\Basket\DeliveryCost\DeliveryCostStrategy;
use AliEhsan\AcmeApp\Basket\Offer\BuyOneGetHalfOffStrategy;
use AliEhsan\AcmeApp\Models\Product;

$productCatalogue = [
    'R01' => new Product('R01', 'Red Widget', 32.95),
    'G01' => new Product('G01', 'Green Widget', 24.95),
    'B01' => new Product('B01', 'Blue Widget', 7.95),
];

$basket = new Basket($productCatalogue, new DeliveryCostStrategy(), [new BuyOneGetHalfOffStrategy('R01')]);

$basket->add('B01');
$basket->add('G01');

echo "\nTotal cost of basket: $" . $basket->total() . "\n\n";
