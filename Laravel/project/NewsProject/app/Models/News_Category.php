<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News_Category extends Model {
    protected $table = 'news_category';
    public $timestamps = false;
    protected $fillable = [
        'news_id',
        'cat_id'
    ];
}