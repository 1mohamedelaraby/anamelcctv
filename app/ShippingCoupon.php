<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;

class ShippingCoupon extends Model
{
    protected $guarded = [];
    protected $error = '';
    protected $info = 'خصم مصاريف شحن';
    protected $amount = 0;


    public function coupon()
    {
        return $this->morphMany(Coupon::class, 'coupon');
    }

    public function discount($shippingCost)
    {
        $this->amount = round($this->value / 100 * $shippingCost);

        return collect([
            'info' => $this->info,
            'amount' => $this->amount,
            'error' => $this->error,
        ]);
    }

    public function getDiscountTypeAttribute()
    {
        return '%';
    }
}
