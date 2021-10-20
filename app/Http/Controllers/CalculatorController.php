<?php

namespace App\Http\Controllers;

use App\Calculator;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function madaBankForm(Calculator $calculator, $checkout)
    {
        return view('calculator.madaBankForm', compact('calculator', 'checkout'));
    }

    public function creditBankForm(Calculator $calculator, $checkout)
    {
        return view('calculator.creditBankForm', compact('calculator', 'checkout'));
    }

    public function payment(Request $request, Calculator $calculator)
    {
        $className = 'App\PaymentGetway\\' . ucfirst($calculator->payment_type) . 'Class';
        $class = new $className;

        if ($class->payment($request)) {
            $calculator->paid = 1;
            $calculator->save();
            Cart::destroy();
            if (auth()->check()) {
                Cart::erase(auth()->id());
            }

            return view('order.complete');
        } else {
            return redirect(route('calculator.index'))->with('error', $class->errorMessage);
        }
    }
}
