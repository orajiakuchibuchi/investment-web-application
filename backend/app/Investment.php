<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'plan_id', 'address','type', 'amount',
         'paying_address',
        'user_id', 'status','created_at', 'updated_at'
    ];
    public function plans(){
        return $this->belongsTo('App\Plan', 'plan_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
