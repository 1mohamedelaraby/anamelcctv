<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = ['type'];

    public static function getCoupon($code)
    {
        return self::firstWhere('code', $code);
    }

    public function coupon()
    {
        return $this->morphTo();
    }


    public function getType()
    {
        $arr = [
            'App\FixedCoupon' => 'خصم إجمالي',
            'App\ShippingCoupon' => 'خصم شحن',
            'App\CategoryCoupon' => 'خصم اقسام',
        ];

        return $arr[$this->coupon_type];
    }
}
