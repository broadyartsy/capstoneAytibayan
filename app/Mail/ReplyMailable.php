<?php


namespace
 
App\Mail;

use
 
Illuminate\Bus\Queueable;
use
 
Illuminate\Mail\Mailable;
use
 
Illuminate\Queue\SerializesModels;
use
 
Illuminate\Contracts\Queue\ShouldQueue;

class ReplyMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    protected $body;
    public $senderName;
    public $recipientName;

    public function __construct($subject, $body, $senderName, $recipientName) {
        $this->subject = $subject;
        $this->body = $body;
        $this->senderName = $senderName;
        $this->recipientName = $recipientName;
    }

    public function build()
    {
        return $this
            ->subject($this->subject)
            ->view('Emails.replies', [
                'name' => $this->recipientName,
                'subject' => $this->subject,
                'body' => $this->body,
                'senderName' => $this->senderName,
            ]);
    }
}
