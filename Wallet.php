<?php

namespace Strategy;

use SebastianBergmann\CodeCoverage\Report\PHP;
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
        {
            echo "Paying $price using Wallet";
            
            $this->setAmountAfterPay($price);
            
        }
           
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
    
    public function setAmountAfterPay(float $price): float
    {
        return $this->amount -= $price;
    }

}
