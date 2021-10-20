<?php

namespace App\Http\Livewire\Store;

use App\Coupon;
use App\Address;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart as ShoppingCart;
use CobraProjects\LaraShop\Facades\LaraShop;

class Cart extends Component
{
    public $total = 0;
    public $newTotal = 0;
    public $grandTotal = 0;
    public $qty = [];
    public $couponCode;
    public $couponError;
    public $couponSuccess;
    public $couponDiscount = 0;
    public $shippingCost = 0;
    public $address;
    public $addresses;
    public $payment_type;
    public $payment_fee = 0;
    public $payment_fee_title;
    public $notes = '';

    public function mount()
    {
        if (auth()->check()) {
            $this->addresses = auth()->user()->addresses;
            $this->address = @$this->addresses->where('primary', 1)->first()->id;
            if ($this->address) {
                $this->shippingCost = Address::find($this->address)->city->shipping_cost;
            }
        }
    }

    public function render()
    {
        $items = LaraShop::cartItems();
        $this->total = round(LaraShop::cartTotal(), 2);
        $this->newTotal = round(LaraShop::cartTotal() - $this->couponDiscount, 2);
        $this->grandTotal = round(LaraShop::cartTotal() - $this->couponDiscount + $this->shippingCost + $this->payment_fee, 2);
        return view('livewire.store.cart', compact('items'));
    }

    public function updated()
    {
        foreach ($this->qty as $key => $value) {
            LaraShop::updateQty($key, $value);
            if (auth()->check()) {
                LaraShop::deleteCart(auth()->user());
                LaraShop::cartLogin(auth()->user());
            }
        }

        if ($this->couponDiscount && !$this->couponCode) {
            $this->couponDiscount = 0;
            $this->couponSuccess = '';
            $this->couponError = '';
        }

        $this->getPaymentFee();
    }

    public function getPaymentFee()
    {
        if ($this->payment_type) {
            $className = 'App\PaymentGetway\\' . ucfirst($this->payment_type) . 'Class';
            $class = new $className;
            if ($class->getFee()) {
                $this->payment_fee = $class->getFee()['amount'];
                $this->payment_fee_title = $class->getFee()['title'];
            } else {
                $this->payment_fee = 0;
            }
        }
    }

    public function updatedAddress()
    {
        $this->shippingCost = Address::find($this->address)->city->shipping_cost;
        $this->getCouponDiscount(0);
    }

    public function getCouponDiscount($error = 1)
    {
        if ($this->couponCode) {
            $discount = Coupon::getCoupon($this->couponCode);
            if (!$discount) {
                $this->couponError = "كود الخصم غير صحيح";
                $this->couponSuccess = '';
                return;
            }

            $discount = $discount->coupon->discount($this->shippingCost);

            if ($discount->get('error')) {
                $this->couponError = $discount->get('error');
                $this->couponSuccess = '';
                return;
            }

            $this->couponDiscount = $discount->get('amount');
            $this->couponError = '';
            $this->couponSuccess = "تم تنفيذ " . $discount->get('info') . " بقيمة " . $this->couponDiscount . " ريال";
        } else {
            if ($error) {
                $this->couponError = "يجب ادخال كود الكوبون!";
                $this->couponSuccess = '';
            }
        }
    }

    public function removeItem($rowId)
    {
        LaraShop::removefromCart($rowId);
        if (auth()->check()) {
            LaraShop::deleteCart(auth()->user());
            LaraShop::cartLogin(auth()->user());
        }
    }

    public function removeDiscount()
    {
        $this->couponDiscount = 0;
        $this->couponCode = '';
        $this->couponError = '';
        $this->couponSuccess = '';
    }


    public function save()
    {
        $this->validate([
            'total' => 'required',
            'address' => 'required',
            'payment_type' => 'required',
        ]);

        $this->updatedAddress(0);
        $this->getPaymentFee();

        $order = auth()->user()->orders()->create([
            'address_id' => $this->address,
            'payment_type' => $this->payment_type,
            'price' => $this->total,
            'shipping_cost' => $this->shippingCost,
            'coupon_discount' => $this->couponDiscount,
            'coupon_code' => $this->couponCode,
            'payment_fee' => $this->payment_fee,
            'notes' => $this->notes,
        ]);

        foreach (LaraShop::cartItems() as $item) {
            $order->details()->create([
                'larashop_product_id' => $item->id,
                'price' => $item->model->price,
                'qty' => $item->qty,
            ]);
        }

        if ($order->payment_type == 'cod') {
            ShoppingCart::destroy();
            if (auth()->check()) {
                laraShop::deleteCart(auth()->user());
            }
        }

        $className = 'App\PaymentGetway\\' . ucfirst($this->payment_type) . 'Class';
        $class = new $className;

        $class->pay($order);
    }
}
