<?php

namespace Strategy;

// TODO: Implement CreditCard Class
class CreditCard implements PaymentStrategy{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $cardNumber;
    /**
     * @var string
     */
    private $expiryDate;
    /**
     * @var string
     */
    private $cvv;

    public function __construct(string $name, string $cardNumber, string $expiryDate, string $cvv)
    {
        $this->name = $name;
        $this->cardNumber = $cardNumber;
        $this->expiryDate = $expiryDate;
        $this->cvv = $cvv;
    }

    public function pay($price)
    {
        $price = (float)$price;
        echo "Paying {$price} using Credit Card";
    }
}