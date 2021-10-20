<?php

namespace App;

use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Database\Eloquent\Model;

class CalculatorDetails extends Model
{
    protected $guarded = [];

    public function calculator()
    {
        return $this->belongsTo(Calculator::class);
    }

    public function product()
    {
        return $this->belongsTo(LarashopProduct::class, 'larashop_product_id', 'id');
    }
}
