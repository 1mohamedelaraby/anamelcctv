<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use CobraProjects\LaraShop\Facades\LaraShop;

class Coupon extends Component
{
    public $editCoupon;
    public $coupon;
    public $FixedCoupon;
    public $ShippingCoupon;
    public $CategoryCoupon;

    public $model;

    public function mount($coupon)
    {
        $this->editCoupon = $coupon;

        $this->coupon['once'] = 0;
        $this->coupon['type'] = 'FixedCoupon';
        $this->FixedCoupon['percent'] = 1;
        $this->FixedCoupon['value'] = '';
        $this->ShippingCoupon['value'] = '';
        $this->CategoryCoupon['value'] = '';
        $this->CategoryCoupon['percent'] = 1;
        $this->CategoryCoupon['type'] = 'all';

        if ($this->editCoupon) {
            $type = Str::of($this->editCoupon->coupon_type)->explode('\\')->last();
            $this->coupon['code'] = $this->editCoupon->code;
            $this->coupon['once'] = $this->editCoupon->once;
            $this->coupon['type'] = $type;
            if ($type == 'FixedCoupon') {
                $this->model = $this->editCoupon->coupon;
                $this->FixedCoupon['percent'] = $this->editCoupon->coupon->percent;
                $this->FixedCoupon['value'] = $this->editCoupon->coupon->value;
            }
            if ($type == 'ShippingCoupon') {
                $this->model = $this->editCoupon->coupon;
                $this->ShippingCoupon['value'] = $this->editCoupon->coupon->value;
            }
            if ($type == 'CategoryCoupon') {
                $this->model = $this->editCoupon->coupon;
                $this->CategoryCoupon['value'] = $this->editCoupon->coupon->value;
                $this->CategoryCoupon['percent'] = $this->editCoupon->coupon->percent;
                $this->CategoryCoupon['type'] = $this->editCoupon->coupon->type;
                $this->CategoryCoupon['categories'] = $this->editCoupon->coupon->categories;
            }
        }
    }

    public function save()
    {
        $data = $this->validate([
            'coupon.code' => 'required|unique:coupons,code' . ($this->editCoupon ? ',' . $this->editCoupon->id : ''),
            'coupon.once' => 'required',
            'coupon.type' => 'required',
            'FixedCoupon.percent' => 'required_if:coupon.type,FixedCoupon',
            'FixedCoupon.value' => 'required_if:coupon.type,FixedCoupon',
            'ShippingCoupon.value' => 'required_if:coupon.type,ShippingCoupon',
            'CategoryCoupon.value' => 'required_if:coupon.type,CategoryCoupon',
            'CategoryCoupon.percent' => 'required_if:coupon.type,CategoryCoupon',
            'CategoryCoupon.type' => 'required_if:coupon.type,CategoryCoupon',
            'CategoryCoupon.categories' => 'required_unless:CategoryCoupon.type,all',
        ]);

        if ($this->editCoupon) {
            $this->model->update($data[$data["coupon"]["type"]]);
            $this->editCoupon->update($data['coupon']);
        } else {
            $couponDetails = ('\App\\' . $data["coupon"]["type"])::create($data[$data["coupon"]["type"]]);
            $couponDetails->coupon()->create($data['coupon']);
        }

        session()->flash('success', 'تم الحفظ بنجاح');
        return redirect()->to(route('admin.shop.coupon.index'));
    }

    public function render()
    {
        return view('livewire.coupon');
    }
}
