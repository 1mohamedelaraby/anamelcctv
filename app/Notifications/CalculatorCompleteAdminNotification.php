<?php

namespace App\Notifications;

use App\Calculator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalculatorCompleteAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $calculator;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('طلب من حاسبة المشاريع:')
            ->line('يمكنك متابعة طلب الشراء من لوحة التحكم من خلال الرابط التالي:')
            ->action('Notification Action', route('admin.shop.calculator.index'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
