<?php

namespace App;

use CobraProjects\LaraShop\Facades\LaraShop;
use Illuminate\Database\Eloquent\Model;

class CategoryCoupon extends Model
{
    protected $guarded = [];
    protected $amount = 0;
    protected $error = '';
    protected $info = 'خصم اقسام';

    public function coupon()
    {
        return $this->morphMany(Coupon::class, 'coupon');
    }

    public function discount()
    {
        $items = LaraShop::cartItems();
        foreach ($items as $item) {
            foreach ($item->model->larashopCategories as $cat) {
                if ($this->hasDiscount($cat)) {
                    $this->amount += $this->getDiscountvalue($item);
                }
            }
        }

        if ($this->amount == 0) {
            $this->error = 'لايمكن تنفيذ هذا الكود على اي من هذه المنتجات!';
        }

        return collect([
            'info' => $this->info,
            'amount' => $this->amount,
            'error' => $this->error,
        ]);
    }

    private function getDiscountValue($item)
    {
        return $this->percent ? round($this->value / 100 * $item->price) : $this->value;
    }

    private function hasDiscount($cat)
    {
        if ($this->type == 'all') {
            return true;
        }

        if ($this->type == 'in') {
            return in_array($cat->id, $this->categories);
        }

        if ($this->type == 'notIn') {
            return !in_array($cat->id, $this->categories);
        }
    }

    public function setCategoriesAttribute($value)
    {
        $this->attributes['categories'] = serialize($value);
    }

    public function getCategoriesAttribute()
    {
        return unserialize($this->attributes['categories']);
    }

    public function getDiscountTypeAttribute()
    {
        return $this->percent ? '%' : 'ريال';
    }
}
