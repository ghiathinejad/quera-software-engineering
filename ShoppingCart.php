<?php

namespace Strategy;

use Iterator;
use Strategy\PaymentStrategy;

class ShoppingCart implements Iterator
{

    private $position;

    private $cartItems = [];

    public function __construct()
    {
        $this->position = 0;
    }


    public function rewind(): void
    {
        $this->position = 0;
    }


    public function current()
    {
        return $this->cartItems[$this->position];
    }


    public function key(): int
    {
        return $this->position;
    }


    public function next(): void
    {
        $this->position += 1;
    }

    public function valid(): bool
    {
        return isset($this->cartItems[$this->position]);
    }

    public function getCartTotal(): float
    {
        $items = $this->getCartItems();
        
        $getPrices = array_map(function ($item) {
            
             return $item->getPrice();
            
        }, $items);

        $total = array_sum($getPrices);
        return $total;
    }

    public function append(CartItem $item): void
    {
        $this->cartItems[] = $item;
    }

    public function getCartItems(): mixed
    {

        return $this->cartItems;
    }


    public function pay(PaymentStrategy $payment): void
    {
        $total = $this->getCartTotal();
        $payment->pay($total);
    }
}