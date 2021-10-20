<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use CobraProjects\LaraShop\Models\LarashopCategory;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Http\Request;

class LarashopProductController extends Controller
{
    public function show(LarashopCategory $larashopCategory, LarashopProduct $larashopProduct)
    {
        return view('store.product.show', compact('larashopCategory', 'larashopProduct'));
    }
}
