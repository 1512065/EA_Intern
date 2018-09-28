<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends AbstractModel {
 
    protected $table = 'category';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
 
    protected $guarded = [
        'id'
    ];
}