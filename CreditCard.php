<?php

namespace Strategy;

class CreditCard implements PaymentStrategy
{
    public function __construct(private string $name ,private string $cardNumber ,private string $expiryDate,private string $cvv)
    {
        
    }

    public function pay($price)
    {
        $price = (float)$price;
        echo "Paying $price using Credit Card";
    }
}
