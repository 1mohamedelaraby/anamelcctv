<?php

namespace App;

use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo(LarashopProduct::class, 'larashop_product_id', 'id');
    }
}
