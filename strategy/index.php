<?php

use Strategy\CartItem;
use Strategy\ShoppingCart;
use Strategy\Wallet;

require __DIR__ . '/vendor/autoload.php';


ini_set('display_errors', 1); ini_set('display_startup_errors', 1);




//$wallet = new Wallet(500);
//$wallet->addAmount(900);
//$wallet->pay(700);

$ShoppingCart = new ShoppingCart();
$ShoppingCart->append(new CartItem('ff' , 2));
$ShoppingCart->append(new CartItem('ffdgdff' , 10));
$ShoppingCart->append(new CartItem('fgfdgfdf' , 30.555));

$ShoppingCart->pay(new Wallet(20000));