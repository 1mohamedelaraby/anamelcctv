<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopProduct;

class CartController extends Controller
{
    public function index()
    {
        return view('store.cart.index');
        return (LaraShop::cartTotal());
        return LaraShop::cartItems();
    }

    public function add(Request $request)
    {
        $product = LarashopProduct::findOrfail($request->product);
        LaraShop::addToCart($product);
        if (auth()->check()) {
            LaraShop::cartLogin(auth()->user());
        }
        return LaraShop::cartItems()->count();
    }
}
