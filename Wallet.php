<?php

namespace Strategy;

use Strategy\PaymentStrategy;

class Wallet implements PaymentStrategy
{
    public function __construct(private float $amount)
    {
        $this->amount = $amount;
    }
    public function pay($price)
    {

        if (($price < $this->amount) or ($price === $this->getAmount()))
            echo "Paying $price using Wallet";
        else
            echo 'Wallet: Insufficient inventory!';
    }

    public function addAmount($amount): void
    {
        $this->amount += $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
