<?php

namespace Strategy;

// TODO: Implement CartItem Class
class CartItem
{
    private $productName;
    private $price;

    public function __construct($productName, $price)
    {
        $this->productName = $productName;
        $this->price = (float)$price;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
        return $this;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setPrice($price)
    {
        $this->price = (float)$price;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
