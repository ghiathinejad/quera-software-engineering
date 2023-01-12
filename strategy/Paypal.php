<?php

namespace Strategy;

// TODO: Implement Paypal Class
class Paypal implements PaymentStrategy{

    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function pay($price)
    {
        $price = (float)$price;
        echo  "Thank you {$this->username} for paying {$price} through PayPal.";
    }

    public function getUsername()
    {
        return $this->username;
    }
}
