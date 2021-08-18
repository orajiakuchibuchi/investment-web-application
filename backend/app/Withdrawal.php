<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    // protected $dateFormat = 'Y-m-d H:i';
    protected $fillable = [
        'investment_id','payment_method', 'paying_address','amount','user_id','status',
    ];
    public function investment(){
        return $this->belongsTo('App\Investment','investment_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
