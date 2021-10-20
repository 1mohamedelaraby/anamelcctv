<?php

namespace App\Http\Controllers;

use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo(LarashopProduct::class);
    }
}
