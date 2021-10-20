<?php

namespace App\Observers;

use App\Helpers\SmsApi;
use App\Calculator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CalculatorCompleteAdminNotification;

class CalculatorObserver
{
    /**
     * Handle the Calculator "created" event.
     *
     * @param  \App\Calculator  $calculator
     * @return void
     */
    public function created(Calculator $calculator)
    {
        Notification::route('mail', 'Anamel.cctv@gmail.com')->notify(new CalculatorCompleteAdminNotification($calculator));

        $message = "طلب من حاسبة المشاريع:";
        $message .= "\n";
        $message .= route('admin.shop.calculator.index');

        SmsApi::send('0557259988', $message);
    }

    /**
     * Handle the Calculator "updated" event.
     *
     * @param  \App\Calculator  $calculator
     * @return void
     */
    public function updated(Calculator $calculator)
    {
        //
    }

    /**
     * Handle the Calculator "deleted" event.
     *
     * @param  \App\Calculator  $calculator
     * @return void
     */
    public function deleted(Calculator $calculator)
    {
        //
    }

    /**
     * Handle the Calculator "restored" event.
     *
     * @param  \App\Calculator  $calculator
     * @return void
     */
    public function restored(Calculator $calculator)
    {
        //
    }

    /**
     * Handle the Calculator "force deleted" event.
     *
     * @param  \App\Calculator  $calculator
     * @return void
     */
    public function forceDeleted(Calculator $calculator)
    {
        //
    }
}
