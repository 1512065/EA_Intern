<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    public static function fetchAll(array $filters = [], &$qb = null)
    {
        $qb = static::whereRaw(1);

        if (array_key_exists("where",$filters)) {
            $where = $filters['where'];
            $key =array_keys($where)[0];
            $val = $where[$key];
            $qb->where($key, 'like', "%$val%");
        }
        if (array_key_exists("sort",$filters)) {
            $sort = (array)$filters['sort'];  
            if (array_key_exists("order",$sort)) {
                $qb->orderBy($sort['sortby'], $sort['order']);
            } else {
                $qb->orderBy($sort['sortby']);
            }
        }
        $limit = 10;
        if (array_key_exists("limit",$filters)) {
            $limit = intval($filters['limit']);
        }
        $qb->limit($lmit);
        //
        if (array_key_exists("alter_query_builder",$filters)) {
            $filters['alter_query_builder']($qb);
            
        }
        //
        if (array_key_exists("get_query_builder",$filters)) {
            $res = $qb;//->get();    
        }
        $res = $qb->get();

        $qb = $this->fetchAll([
            'get_query_builder' => true
        ]);

        $query = $_GET;
        $query['page'] = 3;
        unset($query['sort']);
        $query = http_build_query($query);
        // page=3
           
        return $res;
    }

}