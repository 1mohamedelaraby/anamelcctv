<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(CalculatorDetails::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->attributes['price'] + $this->attributes['payment_fee'];
    }

    public function getPaymentMethodAttribute()
    {
        $array = [
            'cod' => 'دفع عند الاستلام',
            'credit' => 'بطاقة ائتمان',
            'mada' => 'بطاقة مدى',
        ];

        return $array[$this->payment_type];
    }

    public function getInstallmentMethodAttribute()
    {
        $array = [
            '0' => 'بدون تركيب',
            '1' => 'تركيب بدون تمديد',
            '2' => 'تركيب وتمديد',
        ];

        return $array[$this->installment_type];
    }
}
