<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinancialAssistanceStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $description;

    /**
     * Create a new message instance.
     *
     * @param string $description
     */
    public function __construct($description)
    {
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Incoming Financial Assistance Status Update')
            ->view('Emails.financial_assistance_status_update') // Update with your actual email template view
            ->with([
                'description' => $this->description,
            ]);
    }
}
