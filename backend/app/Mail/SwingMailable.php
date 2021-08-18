<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SwingMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $subject;
    public $from;
    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject, $from, $body)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->from = $from;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.swiftTemp')
        ->subject($this->subject)->from($this->from);

    }
}
