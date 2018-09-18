<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_users';
    public $timestamps = false;
 
    protected $fillable = [
        'username',
        'password',
    ];
 
    protected $guarded = [
        'id'
    ];
 
    protected $hidden = ['password', 'remember_token'];
}
