<?php

namespace App\Http\Controllers\Admin;

use App\Calculator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Calculator::orderBy('created_at', 'DESC')->get();
        return view('adminCalculator.index', compact('orders'));
    }

    public function show(Calculator $calculator)
    {
        $calculator->load('details');
        return view('adminCalculator.show', compact('calculator'));
    }

    public function changePaymentStatus(Request $request, Calculator $calculator)
    {
        $calculator->paid = $request->paid;
        $calculator->save();

        return back()->with('success', 'تم تغيير حالة السداد بنجاح');
    }

    public function changeOrderStatus(Request $request, Calculator $calculator)
    {
        $calculator->status = $request->status;
        $calculator->save();

        return back()->with('success', 'تم تغيير حالة الطلب بنجاح');
    }

    public function destroy(Calculator $calculator)
    {
        $calculator->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
