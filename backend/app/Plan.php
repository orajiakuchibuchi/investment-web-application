<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'min_amount', 'max_amount', 'interest', 'maturity'
    ];
    public function investments(){
        return $this->hasMany('App\Investment');
    }
}
