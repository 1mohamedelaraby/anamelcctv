<?php

namespace App\Http\Controllers\Order;

use App\Order;
use Illuminate\Http\Request;
use App\PaymentGetway\MadaClass;
use App\PaymentGetway\CreditClass;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function complete()
    {
        return view('order.complete');
    }

    public function creditBankForm(Order $order, $checkout)
    {
        return view('order.creditBankForm', compact('order', 'checkout'));
    }

    public function madaBankForm(Order $order, $checkout)
    {
        return view('order.madaBankForm', compact('order', 'checkout'));
    }

    public function payment(Request $request, Order $order)
    {
        $className = 'App\PaymentGetway\\' . ucfirst($order->payment_type) . 'Class';
        $class = new $className;

        if ($class->payment($request)) {
            $order->paid = 1;
            $order->save();
            Cart::destroy();
            if (auth()->check()) {
                Cart::erase(auth()->id());
            }

            return view('order.complete');
        } else {
            return redirect(route('cart.index'))->with('error', $class->errorMessage);
        }
    }


    public function purchases()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'DESC')->paginate(20);
        return view('order.purchases', compact('orders'));
    }

    public function payOrder(Order $order)
    {
        $className = 'App\PaymentGetway\\' . ucfirst($order->payment_type) . 'Class';
        $class = new $className;

        return $class->pay($order);
    }
}
