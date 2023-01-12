<?php

namespace Strategy;

use Strategy\PaymentStrategy;

class Paypal implements PaymentStrategy
{
    public function __construct(private string $username,private string $password)
    {
        $this->username = $username;

        $this->password = $password;
    }

    public function pay($price)
    {
        echo "Thank you {$this->getUsername()} for paying $price through PayPal.";
    }

    public function getUsername()
    {
        return $this->username;
    }
}
