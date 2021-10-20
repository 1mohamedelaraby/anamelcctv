<?php

namespace App\PaymentGetway;

use App\Calculator;
use App\Order;

interface PaymentGetwayInterface
{
    public function pay(Order $order);

    public function payCalc(Calculator $calculator);

    public function getFee();
}
