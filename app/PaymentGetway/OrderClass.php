<?php

namespace App\PaymentGetway;

use App\Book;
use App\City;
use App\Order;
use App\Coupon;
use App\Refund;
use App\Country;
use App\Student;
use App\SiteInfo;
use App\Marketing;
use Illuminate\Support\Facades\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderClass
{
    public $amount;
    public $discount = 0;
    public $couponDiscount = 0;
    public $couponError;
    public $shippingCost;
    public $refundDiscount;
    public $total;

    private $paymentGetway;

    public function __construct(PaymentGetwayInterface $paymentGetwayInterface)
    {
        $this->amount = Cart::total();
        $this->discount = $this->setMemberDiscount() > $this->getCouponDiscount() ? $this->setMemberDiscount() : 0;
        $this->couponDiscount = $this->getCouponDiscount() > $this->setMemberDiscount() ? $this->getCouponDiscount() : 0;
        $this->couponDiscount = $this->getMarketingDiscount() > $this->discount ? $this->getMarketingDiscount() : $this->couponDiscount;
        $this->shippingCost = $this->getShippingCost() ?? 0;
        $this->refundDiscount = 0;
        $this->total = $this->getTotal();
        $this->paymentGetway = $paymentGetwayInterface;
    }

    public function calculate(Order $order)
    {
        $this->amount = $order->items->sum(function ($q) {
            return $q->pivot->price * $q->pivot->qty;
        });
        $this->discount = $order->discount ? round($this->amount * 20 / 100) : 0;
        $this->couponDiscount = $this->getOrderCouponDiscount($order) ?? 0;
        $this->shippingCost = $order->shipping_cost;
        $this->refundDiscount = $order->refund_discount;
        $this->total = $this->getTotal();

        $refund_amount = $order->RefundTotal - $this->total;

        if ($refund_amount) {
            $order->total = $this->amount;
            $order->discount = $this->discount;
            $order->coupon_discount = $this->couponDiscount;
            $order->coupon = $this->couponDiscount ? $order->coupon : '';
            $order->refund_amount = $order->paid ? $refund_amount : $order->refund_amount;

            $order->save();

            $info = SiteInfo::first();

            if ($order->paid) {
                Refund::create([
                    'student_id' => $order->student_id,
                    'amount' => $refund_amount,
                    'end_date' => strtotime('+' . $info->refund_period . ' ' . $info->refund_period_type, time()),
                ]);
            }
        }

        return $refund_amount;
    }

    public function setMemberDiscount()
    {
        $totalForDiscount = 0;

        if (auth('web')->check()) {
            if (auth()->user()->isMember()) {
                foreach (Cart::content() as $c) {
                    $totalForDiscount += ($c->model->no_discount ||
                        (auth()->user()->isMember() && $c->model->no_member_discount) ||
                        (auth()->user()->student && $c->model->no_student_discount)) ? 0 : $c->price * $c->qty;
                }
            }
        }

        return ceil(round($totalForDiscount * 20 / 100));
    }

    public function getTotal()
    {
        return round($this->amount - $this->discount - $this->couponDiscount + $this->shippingCost);
    }

    public function getCouponDiscount()
    {
        if (request()->coupon) {
            $items = Cart::content();
            $coupon = Coupon::where('code', request()->coupon)->get();

            if ($coupon->count() && $coupon->first()->isValid()) {
                $coupon = $coupon->first();
                $count = 0;
                $total = 0;
                foreach ($items as $item) {
                    $accept = 1;
                    if ($item->options->model == $coupon->model) {
                        $academy = $item->options->model::find($item->options->id);

                        if ($coupon->province_id && $academy->province_id != $coupon->province_id) {
                            $accept = 0;
                        }

                        if ($coupon->type && $academy->type != $coupon->type) {
                            $accept = 0;
                        }

                        if ($coupon->academy_cat_id && $academy->academy_cat_id != $coupon->academy_cat_id) {
                            $accept = 0;
                        }

                        if ($item->model->no_discount || $item->model->no_coupon_discount) {
                            $accept = 0;
                        }

                        // check if custom coupon
                        if ($coupon->custom == 1) {
                            if (!$coupon->items->contains($item->model)) {
                                $accept = 0;
                            }
                        }

                        // Check max quantity
                        if ($coupon->max_qty && $item->qty > $coupon->qty) {
                            $accept = 0;
                        }

                        if (($item->model->no_discount || $item->model->no_coupon_discount) &&  ($coupon->custom == 1 && $coupon->items->contains($item->model))) {
                            $accept = 1;
                        }

                        if ($accept) {
                            $total += $academy->price;
                            $count++;
                        }
                    }
                }

                if ($coupon->qty && $count >= $coupon->qty) {
                    if (!($coupon->once && auth()->user()->usedCoupon($coupon->code))) {
                        return ceil(!$coupon->percent ? $coupon->discount : $total * $coupon->discount / 100);
                    }
                }
            }
        }

        return 0;
    }

    public function getMarketingDiscount()
    {
        if (request()->coupon) {
            $items = Cart::content();
            $coupon = Marketing::where('phone', request()->coupon)->where('used', 0)->get();

            if ($coupon->count()) {
                $coupon = $coupon->first();
                $total = 0;

                foreach ($items as $item) {
                    $academy = $item->options->model::find($item->options->id);
                    $total += $academy->price;
                }

                $coupon->used = 1;
                $coupon->save();

                return ceil($total * 5 / 100);
            }
        }
    }

    public function getOrderCouponDiscount($order)
    {
        if ($order->coupon) {
            $items = $order->items;
            $coupon = Coupon::where('code', $order->coupon)->get();

            if ($coupon->count() && $coupon->first()->isValid()) {
                $coupon = $coupon->first();
                $count = 0;
                $total = 0;
                foreach ($items as $item) {
                    $accept = 1;

                    if (get_class($item) == $coupon->model) {
                        $academy = $item;

                        if ($coupon->province_id && $academy->province_id != $coupon->province_id) {
                            $accept = 0;
                        }

                        if ($coupon->type && $academy->type != $coupon->type) {
                            $accept = 0;
                        }

                        if ($coupon->academy_cat_id && $academy->academy_cat_id != $coupon->academy_cat_id) {
                            $accept = 0;
                        }

                        if ($accept) {
                            $total += $academy->price;
                            $count++;
                        }
                    }
                }

                if ($coupon->qty && $count >= $coupon->qty) {
                    return ceil(!$coupon->percent ? $coupon->discount : $total * $coupon->discount / 100);
                }
            }
        }
    }

    public function getShippingCost()
    {
        if (Request::has('shipping')) {
            if (request()->shipping == 1) {
                // توصيل مجاني للرياض
                $freeShippingBooks = Book::where('no_shipping_riyadh', 1)->pluck('id')->all();
                $isFree = false;
                $isNotFree = false;
                foreach (Cart::content() as $c) {
                    if ($c->options->model == 'App\Book') {
                        if (in_array($c->model->id, $freeShippingBooks)) {
                            $isFree = true;
                        } else {
                            $isNotFree = true;
                        }
                    }
                }
                if (request()->city_id == 5 && $isFree == true && $isNotFree == false) {
                    return 0;
                }
                return request()->city_id ? City::find(request()->city_id)->shipping_cost : (request()->country_id ? Country::find(request()->country_id)->shipping_cost : 0);
            }
        }
    }

    public function getRefunds()
    {
        $amount = $this->getTotal();
        if (Request::has('refunds')) {
            $student = Student::find(auth()->id());
            $refundsTotal = $student->getRefundsTotal();
            $refunds = $student->getRefunds();

            if ($amount >= $refundsTotal) {
                $this->refundDiscount = $refundsTotal;
                //$this->discount +=  $refundsTotal;
                $student->getRefunds()->each->delete();
            } else {
                $this->refundDiscount = $this->getTotal();
                //$this->discount += $amount;
                $this->editRefunds($amount, $refunds);
            }
        }
    }

    public function editRefunds($amount, $refunds)
    {
        foreach ($refunds as $refund) {
            if ($amount < $refund->amount) {
                $refund->amount -= $amount;
                $refund->save();
                break;
            } elseif ($amount == $refund->amount) {
                $refund->delete();
                break;
            } else {
                $newAmount = $amount - $refund->amount;
                $refund->delete();
                $newRefunds = Student::find(auth()->id())->getRefunds();
                $this->editRefunds($newAmount, $newRefunds);
                break;
            }
        }
    }
}
