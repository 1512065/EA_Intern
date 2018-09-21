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
        $del_category = Category::find($id);
        $del_category->delete();
        return redirect('category');
    }

    public function editCategory(Request $request){
        //add new category
        
        $name = $request->input('new_name');
        $new_parent =  $request->input('new_parent');
        $cat_id = $request->input('cat_id');

        $item = Category::find($cat_id);
        echo $cat_id;

        $item->name = $name;
        $item->save();
 /*
        $parent = Category_Group::where('cat_id','=',$cat_id)->get()->first();
        $parent_id = $parrent->parent_id;
        if ($new_parent !== $parent_id && $new_parent!==0) {
            $parent->delete();
            $new_relation = new Category_Group;
            $new_relation->parent_id = $new_parent;
            $new_relation->cat_id = $cat_id;
            $new_relation->save();
        }*/
    }
}