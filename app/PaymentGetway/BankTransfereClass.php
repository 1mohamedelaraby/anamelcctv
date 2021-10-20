<?php

namespace App\PaymentGetway;

use App\Calculator;
use App\Order;
use App\PaymentGetway\PaymentGetwayInterface;

class BankTransfereClass implements PaymentGetwayInterface
{
    public function getFee()
    {
        return false;
    }

    public function pay(Order $order)
    {
        if ($order->totalPrice <= 0) {
            $order->paid = 1;
            $order->save();
        }
        return redirect(route('order.complete'));
    }

    public function payCalc(Calculator $calculator)
    {
        if ($calculator->price <= 0) {
            $calculator->paid = 1;
            $calculator->save();
        }
        return redirect(route('order.complete'));
    }
}
