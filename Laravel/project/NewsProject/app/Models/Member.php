<?php  namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class Member extends Authenticatable{
 
    protected $table = 'member';
    public $timestamps = false;
 
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'mobile',
        'active'
    ];
 
    protected $guarded = [
        'id'
    ];
 
    protected $hidden = ['password', 'remember_token'];
}