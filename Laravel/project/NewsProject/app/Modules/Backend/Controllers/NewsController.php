<?php   
namespace App\Modules\Backend\Controllers;

use Auth;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\News;
use App\Models\News_Category;
use App\Models\Comment;
class NewsController extends Controller{
    public function addNews(Request $request){
        //add to news
        $title = $request->input('title');
        $content = $request->input('content');
        $category_arr = $request->input('category');
        if (!isset($title))
        {
            return redirect('addnews')->with('message', 'Error: Please input Title !!');
        }
        if (!isset($content))
        {
            return redirect('addnews')->with('message', 'Error: Please input News content !!');
        }
        if (isset($category_arr[0])) {
            $record = new News;
            $record->title = $title;
            $record->content = $content;
            $record->save();
            //add category
            foreach ($category_arr as $category) {
                $relation = new News_Category;
                $relation->news_id = $record->id;
                $relation->cat_id = $category;
                $relation->save();
            }
        } else { //no category
            return redirect('addnews')->with('message', 'Error: Please select at least 1 category !!');
        }
        return redirect('addnews')->with('message', 'News was successfully added !!');
    }

    public function deleteNews($id) {
        // delete relation news_category
        $relation = News_Category::where('news_id','=',$id)->delete();
        $del_news = News::find($id);
        $del_news->delete();
        return redirect('news')->with('message','News was deleted');
    }

    public function editNews(Request $request){
        $news_id = $request->input('news_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $category_arr = $request->input('category');
        if (!isset($title))
        {
            return redirect('/news/edit/'.$news_id)->with('message', 'Error: Please input Title !!');
        }
        if (!isset($content))
        {
            return redirect('/news/edit/'.$news_id)->with('message', 'Error: Please input News content !!');
        }
        if (isset($category_arr[0])) {
            // change news info
            $news = News::find($news_id);
            $news->title = $title;
            $news->content = $content;
            $news->save();
            // change category
            $relation = News_Category::where('news_id','=', $news_id)->get()->sortBy('cat_id')->toArray();
            //var_dump($relation);
            $i = 0;
            $old_cate_arr = [];
            foreach ($relation as $record) {
                $old_cate_arr[$i] = $record['cat_id'];
                $i++; 
            }
           
            //delete old relation 
            foreach ($old_cate_arr as $old_cate) {
                if (in_array($old_cate, $category_arr)=== false) {
                    News_Category::where('news_id', '=', $news->id)->where('cat_id','=', $old_cate)->delete();
                }
            }
            //add new relation
            foreach ($category_arr as $new_cate) {
                if (in_array($new_cate, $old_cate_arr)=== false) {
                   $new_relation = new News_Category;
                   $new_relation->news_id = $news_id;
                   $new_relation->cat_id = $new_cate;
                   $new_relation->save();
                }
            } 
        } else { //no category
            return redirect('/news/edit/'.$news_id)->with('message', 'Error: Please select at least 1 category !!');
        }
        return redirect('/news/edit/'.$news_id)->with('message', 'News was edited!!');
    }

    public function filterNews() {

         $param =[];
         if(isset($_GET['key'])) {
            $param['where'] = [ 'title' => $_GET['key']];
         }
         if(isset($_GET['sortby'])) {
             $param['sort'] = array('sortby' => $_GET['sortby']);
         }
         if (isset($_GET['order'])) {
             $param['sort']['order'] = $_GET['order'];
         }
         if (isset($_GET['limit'])) {
             $param['limit'] = $_GET['limit'];
         }
         if (isset($_GET['page'])) {
            $param['page'] = $_GET['page'];
        }
         //print_r($_GET);
         $result = News::fetchAll($param);
         /*
         foreach ($rows as $row) {
             echo $row->id;
         }*/
         return view('Backend::page.news.index')->with(['rows'=> $result['rows'], 'count'=>$result['count']]);
     }

    public function addComment($id) {
        $comment = new Comment;
        $comment->user_id = 1;
        $comment->news_id = $id;
        $comment->content =$_GET['content'];
        $comment->status = 'pending';
        $comment->save();
        $url = "/news/$id";
        return redirect($url)->with('id',$id);
    }
    public function approveComment($id, $cmt_id) {
        $comment = Comment::where('comment_id','=',$cmt_id)->first();
        $comment->status = 'approved';

        $comment->save();
        $url = "/news/$id";
        return redirect($url)->with('id',$id);
    }
    public function deleteComment($id) {
        $comment = Comment::where('comment_id','=',$id)->first();
        $comment->status = 'deleted';
        $comment->save();
        $url = "/news/$id";
        return redirect($url)->with('id',$id);
    }
}