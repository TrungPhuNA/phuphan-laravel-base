<?php

namespace App\Mail\Test;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTest extends Mailable
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
            ->view('test.mail.mail-test', $this->mailData);
    }
}
