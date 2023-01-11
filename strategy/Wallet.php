<?php

namespace Strategy;

// TODO: Implement Wallet Class
class Wallet implements PaymentStrategy{

    private $amount;

    public function __construct($amount)
    {
        $this->amount = (float)$amount;
    }

    public function pay($price)
    {
        $price = (float)$price;
        if ($price <= $this->amount){
            echo "Paying {$price} using Wallet".PHP_EOL;
        }else{
           echo "Wallet: Insufficient inventory!".PHP_EOL;
        }
    }

    public function addAmount($amount){
        $this->amount += (float)$amount;
    }

    public function getAmount(){
        return $this->amount;
    }

}