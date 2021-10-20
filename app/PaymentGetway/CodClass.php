<?php

namespace App\PaymentGetway;

use App\Order;
use App\Calculator;
use App\PaymentGetway\PaymentGetwayInterface;

class CodClass implements PaymentGetwayInterface
{
    private $fee = [
        'title' => 'الدفع عند الاستلام',
        'amount' => 20
    ];

    public function getFee()
    {
        return $this->fee;
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
