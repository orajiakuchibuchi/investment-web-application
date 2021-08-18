<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalApprovalMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $amount;
    public $address;
    public $method;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($amount, $address,  $method)
    {
        $this->amount = $amount;
        $this->address = $address;
        $this->method = $method;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.withdrawalApproval')
        ->subject('Withdrawal Approved')->from('no-reply@topfinanceltd.com');
    }
}
