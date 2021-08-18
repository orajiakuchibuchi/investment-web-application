<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginDeviceNoticeMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $browser;
    public $userAgent;
    public $os;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($browser, $userAgent, $os)
    {
        $this->browser = $browser;
        $this->userAgent = $userAgent;
        $this->os = $os;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.loginNotice')
            ->subject('Login notice. Top Finance LTD')->from('no-reply@topfinance.com');
    }
}
