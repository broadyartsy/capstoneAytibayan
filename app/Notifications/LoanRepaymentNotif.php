<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanRepaymentNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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

        $currentTime = now()->format('Y-m-d H:i:s');

        return (new MailMessage)
                    ->line('Your loan repayment was successful!')
                    ->line('Your remaining loan balance is ' . $notifiable->loan->remaining_loan_balance. ' as of ' . $currentTime)
                    ->action('Go to Web App', route('visitor.home'))
                    ->line('For more information, you may login to our web application by clicking the button above.')
                    ->line('You may send an inquiry or contact your program Project Coordinator.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
