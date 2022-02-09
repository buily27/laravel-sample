<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    private $messages;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return 
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->view('mails.sendMail', ['messages' => $this->messages])->subject($this->messages['title']);
    }
}
