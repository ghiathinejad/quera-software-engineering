<?php

namespace Strategy;

use Strategy\PaymentStrategy;

class Wallet implements PaymentStrategy
{
    public function __construct(private $amount)
    {
        $this->amount = $amount;
    }
    public function pay($price)
    {
        $price = (float)$price;
        
        if($price > $this->amount)
        {
            echo 'Wallet: Insufficient inventory!';
            return;
        }
        
        echo "Paying $price using Wallet";

    }

    public function addAmount($amount) : void
    {
        $this->amount += $amount;
    }

    public function getAmount() : float
    {
        return $this->amount;
    }
}
