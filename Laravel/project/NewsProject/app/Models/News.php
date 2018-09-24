<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model {
    protected $table = 'news';
    public $timestamps = true;
    protected $fillable = [
        'content',
        'title'
    ];
    protected $guarded = [
        'id'
    ];
}