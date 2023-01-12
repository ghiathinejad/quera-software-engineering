<?php

namespace Strategy;

// TODO: Implement Wallet Class
class Wallet implements PaymentStrategy{

    private float $amount;

    public function __construct($amount)
    {
        $this->amount = (float)$amount;
    }

    public function pay($price)
    {
        $price = (float)$price;
        if ($price <= $this->amount){
            $this->amount = $this->amount - $price;
            echo "Paying {$price} using Wallet";
        }else{
            echo "Wallet: Insufficient inventory!";
        }
    }

    public function addAmount($amount){
        $this->amount += (float)$amount;
    }

    public function getAmount(){
        return $this->amount;
    }

}