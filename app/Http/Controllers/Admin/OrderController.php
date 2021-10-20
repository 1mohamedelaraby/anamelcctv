<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::with('user', 'shippingAddress')->orderBy('created_at', 'DESC')->get();
        return view('adminOrder.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('shippingAddress', 'user', 'details');
        return view('adminOrder.show', compact('order'));
    }

    public function changePaymentStatus(Request $request, Order $order)
    {
        $order->paid = $request->paid;
        $order->save();

        return back()->with('success', 'تم تغيير حالة السداد بنجاح');
    }

    public function changeOrderStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'تم تغيير حالة الطلب بنجاح');
    }
}
