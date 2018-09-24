<?php   
namespace App\Modules\Backend\Controllers;

use Auth;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Category_Group;
class CategoryController extends Controller{

    public function addCategory(Request $request){
        //add new category
        $name = $request->input('new_category');
        $category = new Category;
        $category->name = $name;
        $category->save();
        //add to parent
        $parent_id = $request->input('new_parent');
        if ($parent_id > 0) {
            $relation = new Category_Group;
            $relation->cat_id = $category->id;
            $relation->parent_id = $parent_id;
            $relation->save();
        }
        
        return redirect('addcategory')->with('message', '"'.$name.'" added to Category!!');
    }

    public function deleteCategory($id) {
        try {
            // delete relation
            $relation = Category_Group::where('cat_id','=',$id)->get()->first();
            if (isset($relation->parent_id)) {
                $record = Category_Group::where('cat_id','=',$id)->delete();
            }
            $del_category = Category::find($id);
            $del_category->delete();
        } catch (\Illuminate\Database\QueryException $ex){
            
            return redirect('category')->with('message',$ex->getMessage());
        }
        return redirect('category')->with('message','Category was deleted');
    }

    public function editCategory(Request $request){
        //change name
        $rows = Category::fetchAll([
            'where' => [
                'category_name' => 'abc'
            ]
        ]);
        dd($rows);


        $name = $request->input('new_name');
        $cat_id = $request->input('cat_id');
        $item = Category::find($cat_id);
        $item->name = $name;
        $item->save();
        //change parent
        $new_parent = $request->input('new_parent');
        // choose to change parent
        if ($new_parent != -1) {
            //delete old parent
            $parent = Category_Group::where('cat_id','=',$cat_id)->get()->first();
            
            if (isset($parent->parent_id)) {
                $relation = Category_Group::where('cat_id','=',$cat_id)->delete();
            }
            if ($new_parent !== 0) {
                $new_relation = new Category_Group;
                $new_relation->parent_id = $new_parent;
                $new_relation->cat_id = $cat_id;
                $new_relation->save();
            }
        }
        return redirect('category')->with('message', 'Edited successfully!!');
    }
}