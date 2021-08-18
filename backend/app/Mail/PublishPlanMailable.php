<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PublishPlanMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $min_amount;
    public $max_amount;
    public $interest;
    public $maturity;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $min_amount, $max_amount, $interst, $maturity)
    {
        $this->name = $name;
        $this->min_amount = $min_amount;
        $this->max_amount = $max_amount;
        $this->interest = $interst;
        $this->maturity = $maturity;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.publishPlan')
            ->subject('New investmet plan')->from('invest@topfinance.com');
    }
}
