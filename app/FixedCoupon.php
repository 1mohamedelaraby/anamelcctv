<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CobraProjects\LaraShop\Facades\LaraShop;

class FixedCoupon extends Model
{
    protected $guarded = [];
    protected $error = '';
    protected $info = 'خصم على الاجمالي';
    protected $amount = 0;

    public function coupon()
    {
        return $this->morphMany(Coupon::class, 'coupon');
    }

    public function discount()
    {
        $this->amount = $this->percent ? round($this->value / 100 * LaraShop::cartTotal()) : $this->value;


        return collect([
            'info' => $this->info,
            'amount' => $this->amount,
            'error' => $this->error,
        ]);
    }

    public function getDiscountTypeAttribute()
    {
        return $this->percent ? '%' : 'ريال';
    }
}
