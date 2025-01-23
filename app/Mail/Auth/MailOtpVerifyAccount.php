<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailOtpVerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->subject($this->mailData["title"])
            ->from(env('MAIL_SENDER_EMAIL'), env('MAIL_FROM_ADDRESS'))
            ->view('auth.email.email-otp', $this->mailData);
    }
}
