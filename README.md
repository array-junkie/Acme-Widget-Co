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

### Assumptions
- We are having product catalogue of unique product code identifier (R01+B01+G01).
- If basket have two or more products of (R01) code, then we are considering every second red-widget product on half price. E.g (R01 + R01 One will be on full price and other will be half price) 
- And then there is a functionality calculating the total of basket by considering the (Buy one red widget , get the second on half price + Delivery charges applicable on base of total of basket).

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



## Directory Structure

```plaintext
src/
  Basket/
    DeliveryCost/
        DeliveryCostInterface       # Contract for delivery cost
        DeliveryCostStrategy        # Delivery cost calculation logic
    Offer/
        BuyOneGetHalfOffStrategy    # "Buy one, get one half off" offer
        OfferInterface              # Contract for offers
    Models/
        Product.php                 # Product model
    Exceptions/
        ProductNotFoundException
    Basket.php                      # Main basket implementation
    BasketInterface.php             # Basket contract
tests/
    BasketTest.php                  # PHPUnit tests for the basket
.gitignore                          
composer.json                       # Composer configuration
composer.lock
dockerfile                          # Dockerfile for PHP environment
index.php                           # Index file
```

## Architecture & Development
The application is designed based on: 
- PHP
- Composer
- Phpstan
- Strategy Pattern

# Getting Started
## Setup Development Environment
- Prerequisites
  - PHP >= 8.2
  - Git 
    (For installation, please see the [documentations](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git))
  - Composer
    (For installation, please see the [documentations](https://getcomposer.org/download))

## Installation

- Following are the steps to setup the project locally

    1. Clone the repository inside any folder in the system 
        ```sh
        git clone https://github.com/array-junkie/Acme-Widget-Co.git
        ```
    2. Change directory to project's root directory
        ```sh
        cd Acme-Widget-Co
        ```
    3. Install dependent packages using composer.
        ```sh
        composer install
        ```

- Verification
  - For local run the command.
    ```sh
    php index.php
    ```

---


## Installation using docker

- Go to the project directory.
  - Run the command.
    ```sh
    docker build -t acme_app .
    ```
- After successfull build.
  - Run the command.
    ```sh
    docker run acme_app
    ```
---


## Running Unit Test-Cases

- Go to the project directory.
  - Run the command.
    ```sh
    ./vendor/bin/phpunit tests
    ```
- After above command you will get the test results.
---


## Running PhpStan for analysis

- Go to the project directory.
  - Run the command.
    ```sh
    vendor/bin/phpstan analyse src tests
    ```
- After above code you will get the static analysis of phpstan on whole code.