<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationUrl;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($verificationUrl, $user)
    {
        $this->verificationUrl = $verificationUrl;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Custom Verify Email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->markdown('emails.custom-verify-email')
                    ->subject('Verify Your Email Address')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                        'user' => $this->user,
                    ]);
    }
}
