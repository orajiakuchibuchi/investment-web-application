<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailer extends Model
{
    protected $fillable = [
        'role', 'email', 'password','coin_balance','chat_id',
    ];
}
