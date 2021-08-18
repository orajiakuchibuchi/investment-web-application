<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestmentNotificationMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $address;
    public $coin;
    public $amount;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $address, $amount, $coin)
    {
        $this->name = $name;
        $this->address = $address;
        $this->amount = $amount;
        $this->coin = $coin;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.investmentRequestNotification')
        ->subject('Notification: New Investor')->from('no-reply@topfinanceltd.com');
    }
}
