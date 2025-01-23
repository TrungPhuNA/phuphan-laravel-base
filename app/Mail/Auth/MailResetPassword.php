<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $mailData;
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject($this->mailData["title"])
            ->from(env('MAIL_SENDER_EMAIL'), env('MAIL_FROM_ADDRESS'))
            ->view('auth.email.email-reset-password', $this->mailData);
    }

}
