<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    public static function fetchAll(array $filters = [])
    {
        $qb = static::whereRaw(1);

        $where = (array)$filters['where'];
        $sort = (array)$filters['sort'];

        

        if ($where[$prop])
        {
            $qb->whereLike($prop, $where['category_name']);
        }

        die($qb->toSql());
    }
}