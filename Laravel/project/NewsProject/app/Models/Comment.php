<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
 
    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = [
        'news_id',
        'user_id',
        'status',
        'content'
    ];
 
    protected $guarded = [
        'id'
    ];
}