# ACME App Basket System

## Overview

This application implements a basket system for **Acme Widget Co.**, allowing customers to:
- Add products to a basket.
- Calculate the total cost of the basket, including:
  - Special offers (e.g., "Buy one red widget, get the second at half price").
  - Delivery costs based on the basket's subtotal.

The project is built using **PHP** and adheres to clean coding practices, including:
- **Dependency Injection**
- **Strategy Pattern**
- **PSR-4 Autoloading**

---

## Features

1. **Product Management**  
   Products are represented with:
   - `code` (e.g., `R01`, `G01`)
   - `name` (e.g., "Red Widget")
   - `price` (e.g., `32.95`)

2. **Basket System**  
   - Add products by their `code`.
   - Calculate the total cost, including:
     - Discounts from special offers.
     - Delivery costs based on subtotal rules.

3. **Special Offers**  
   This implementation supports the following offer:
   - "Buy one red widget, get the second at half price."

4. **Delivery Costs**  
   Delivery charges are based on the subtotal:
   - Subtotal < $50: $4.95
   - Subtotal < $90: $2.95
   - Subtotal ≥ $90: Free delivery

---

## Directory Structure

```plaintext
src/
  Basket/
    Basket.php               # Main basket implementation
    BasketInterface.php      # Basket contract
    DeliveryCostCalculator.php # Delivery cost calculation logic
    DeliveryCostStrategy.php # Strategy for delivery costs
    Offer/
      OfferInterface.php     # Contract for offers
      BuyOneGetHalfOff.php   # "Buy one, get one half off" offer
  Models/
    Product.php              # Product model
tests/
  BasketTest.php             # PHPUnit tests for the basket
composer.json                # Composer configuration
phpstan.neon                 # PHPStan configuration
docker-compose.yml           # Docker configuration
Dockerfile                   # Dockerfile for PHP environment