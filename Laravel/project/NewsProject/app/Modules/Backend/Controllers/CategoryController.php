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
        return redirect('editcategory');
    }

    public function editCategory($id) {
        echo $id;
    }
}