<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category_Group extends Model {
    protected $table = 'category_group';
    public $timestamps = false;
    protected $fillable = [
        'cat_id',
        'parent_id'
    ];
}