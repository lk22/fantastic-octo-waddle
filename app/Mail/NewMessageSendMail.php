<?php

namespace Notifier\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $sender = [])
    {
        $this->sender = $sender;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-message');
    }
}
