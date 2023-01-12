<?php

namespace Strategy;

// TODO: Implement ShoppingCart Class
class ShoppingCart implements \Iterator
{
    private int $position;
    private mixed $cartItems = [];

    public function __construct($array = [])
    {
        $this->cartItems = $array;
        $this->position = 0;
    }

    public function current(): array
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

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->cartItems[$this->position]);
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return array|mixed
     */
    public function getCartItems(): mixed
    {
        return $this->cartItems;
    }

    /**
     * @param array|mixed $cartItems
     */
    public function setCartItems(mixed $cartItems): void
    {
        $this->cartItems = $cartItems;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function append($carItem): void
    {
        $this->cartItems[] = $carItem;
    }

    public function getCartTotal(): float
    {
        $cars = $this->getCartItems();
        $amount = 0;
        foreach ($cars as $car){
            $amount += (float)$car->getPrice();
        }

        return $amount;
    }


    public function pay(PaymentStrategy $payment)
    {
        $payment->pay($this->getCartTotal());
    }
}