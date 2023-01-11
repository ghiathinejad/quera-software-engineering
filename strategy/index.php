<?php
require __DIR__ . '/vendor/autoload.php';

use Strategy\CartItem;
use Strategy\Wallet;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1);




$wallet = new Wallet(500);
$wallet->addAmount(900);
$wallet->pay(700);