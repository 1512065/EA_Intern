<?php  
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    private static $limit = 10;
 
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
        $count_res =  $qb->get()->count();
       // echo $count_res;
        if (array_key_exists("page",$filters)) {
            $offset = ($filters['page']-1) * self::$limit;
            $qb->skip($offset);
        }
        if (array_key_exists("limit",$filters)) {
            //$limit = intval($filters['limit']);
            self::$limit =$filters['limit'];
        }
        $qb->limit(self::$limit);


        $res = $qb->get();
        /*
        //
        if (array_key_exists("alter_query_builder",$filters)) {
            $filters['alter_query_builder']($qb);
            
        }
        //
        if (array_key_exists("get_query_builder",$filters)) {
            $res = $qb;//->get();    
        }
       

        $qb = $this->fetchAll([
            'get_query_builder' => true
        ]); */

        $result = array('rows'=>$res, 'count'=>$count_res);
        return $result;
    }
    public static function getLimit() {
        return self::$limit;
    }
}