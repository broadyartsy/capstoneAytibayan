<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WebsiteNotifications extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    /**
     * The title of the notification.
     *
     * @var string
     */
    public $date;
    public $time;
    public $message;

    public function __construct($message, $date, $time)
{
    $this->message = $message;
    $this->date = $date;
    $this->time = $time;
}
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $ampmTime = \Carbon\Carbon::parse($this->time)->format('h:i A');

        return [
            'message' => $this->message,
            'date' => $this->date,
            'time' => $ampmTime,
        ];
    }
}
