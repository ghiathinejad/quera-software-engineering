<?php

namespace Strategy\test;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Iterator;
use Strategy\CartItem;
use Strategy\PaymentStrategy;
use Strategy\ShoppingCart;

class SampleTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require __DIR__ . '/../CartItem.php';
        require __DIR__ . '/../ShoppingCart.php';
    }

    public function testNewCartItemProductName()
    {
        $cartItem = new CartItem('younes', 1);
        $this->assertSame('younes', $cartItem->getProductName());
    }

    public function testNewCartItemPrice()
    {
        $cartItem = new CartItem('younes', 1);
        $this->assertSame((float)1, $cartItem->getPrice());
    }

    public function testAppend()
    {
        $cartItem = new CartItem('younes', 1);

        $cart = new ShoppingCart();
        $cart->append($cartItem);

        $this->assertEquals($cartItem, $cart->getCartItems()[0]);
    }

    public function testShoppingCartImplementsIterator()
    {
        $shoppingCartReflection = new ReflectionClass(ShoppingCart::class);
        self::assertTrue($shoppingCartReflection->implementsInterface(Iterator::class));
    }

    public function testShoppingCartHasPay()
    {
        $paymentStrategyReflection = new ReflectionClass(PaymentStrategy::class);
        self::assertTrue($paymentStrategyReflection->isInterface());
        self::assertTrue($paymentStrategyReflection->hasMethod('pay'));
    }

}