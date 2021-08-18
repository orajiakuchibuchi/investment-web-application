<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestmentRequestMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $amount;
    public $coin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $amount, $coin)
    {
        $this->name = $name;
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
        return $this->view('emails.investmentRequest')
        ->subject('Investment request received')->from('no-reply@topfinanceltd.com');
    }
}
