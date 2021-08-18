<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IdentityViolationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $fee;
    public $due;
    public $limit;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fee)
    {
        $this->fee = $fee;
        $this->limit = 400;
        $this->due = 24;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.identityViolation')
        ->subject('Re: Account status follow up')->from('support@topfinanceltd.com');
    }
}
