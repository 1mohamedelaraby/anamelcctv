<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relations
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shippingAddress()
    {
        return $this->belongsTo('App\Address', 'address_id', 'id');
    }

    public function details()
    {
        return $this->hasMany('App\OrderDetails');
    }

    // attributes
    public function getTotalPriceAttribute()
    {
        return $this->price + $this->shipping_cost + $this->payment_fee - $this->coupon_discount;
    }

    public function getAddressAttribute()
    {
        if ($this->user_id) {
            return $this->shippingAddress->address;
        } else {
            $this->attributes['address'];
        }
    }

    public function getFirstNameAttribute()
    {
        if ($this->user_id) {
            return Str::of($this->user->name)->explode(' ')->first();
        } else {
            $this->attributes['first_name'];
        }
    }

    public function getLastNameAttribute()
    {
        if ($this->user_id) {
            return Str::of($this->user->name)->explode(' ')->last();
        } else {
            $this->attributes['last_name'];
        }
    }

    public function getFullNameAttribute()
    {
        return $this->First_name . ' ' . $this->last_name;
    }

    public function getCityAttribute()
    {
        if ($this->user_id) {
            return $this->shippingAddress->city->name;
        } else {
            $this->attributes['city'];
        }
    }

    public function getEmailAttribute()
    {
        if ($this->user_id) {
            return $this->user->email;
        } else {
            $this->attributes['email'];
        }
    }

    public function getPhoneAttribute()
    {
        if ($this->user_id) {
            return $this->shippingAddress->phone;
        } else {
            $this->attributes['phone'];
        }
    }

    public function getPostcodeAttribute()
    {
        if ($this->user_id) {
            return $this->shippingAddress->postcode;
        } else {
            $this->attributes['postcode'];
        }
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
}
