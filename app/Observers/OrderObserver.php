<?php

namespace App\Observers;

use App\Helpers\SmsApi;
use App\Order;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompleteNotification;
use App\Notifications\OrderCompleteAdminNotification;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $order->user->notify(new OrderCompleteNotification($order));
        Notification::route('mail', 'Anamel.cctv@gmail.com')->notify(new OrderCompleteAdminNotification($order));

        $message = "طلب شراء جديد برقم: ' . $order->id";
        $message .= "\n";
        $message .= route('admin.shop.order.index');

        SmsApi::send('0557259988', $message);
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
