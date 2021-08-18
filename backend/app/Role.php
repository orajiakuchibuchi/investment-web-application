<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
    ];
    public static $A = 1;
    public static $I = 2;

    public function users(){
        return $this->hasMany(User::class, 'role_id');
    }
}
