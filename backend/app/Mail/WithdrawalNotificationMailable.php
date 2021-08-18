<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalNotificationMailable extends Mailable
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
        $this->coin = $coin;
        $this->amount = $amount;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.withdrawalRequestNotification')
        ->subject('Notification: New Withdraw request')->from('no-reply@topfinanceltd.com');
    }
}
