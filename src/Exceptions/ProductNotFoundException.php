<?php

namespace AliEhsan\AcmeApp\Exceptions;

class ProductNotFoundException extends \Exception
{
    public function __construct(string $message = 'Product not found.')
    {
        parent::__construct($message);
    }
}