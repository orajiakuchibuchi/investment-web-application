<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BullBear extends Model
{
    protected $fillable = [
        'action','coin', 'address','amount','user_id',
    ];
    public function user(){
        $this->belongsTo('App\User','user_id');
    }
}
