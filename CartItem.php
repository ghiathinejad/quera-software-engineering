<?php

namespace Strategy;

class CartItem
{

    public function __construct(private $productName,private $price)
    {
        $this->setProductName($productName);
        
        $this->setPrice($price);
    }


    public function setProductName($productName) : self
    {
        $this->productName = $productName;
        return $this;
    }



    public function setPrice($price) : self
    {
        $this->price = (float)$price;
        return $this;
    }



    public function getProductName() : string
    {
        return $this->productName ;
    }

    

    public function getPrice() : float
    {
        return $this->price;
    }




}
