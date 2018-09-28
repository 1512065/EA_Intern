
@extends('layout.layout')
@section('title', 'View News')
@section('content')

@if(Session::has('message'))
    <div style="margin: 10px 20px; background-color: rgb(49, 106, 170);">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif

<?php
    // get data 
    use App\Models\News;
    use App\Models\News_Category;
    use App\Models\Category;
    use App\Models\Comment;
    $news = News::find($id);
    $relation = News_Category::where('news_id','=', $id)->get()->toArray();
    $category = "";
    foreach ($relation as $record) {
        $cate = Category::find($record['cat_id']);
        $category = ' - '.$cate->name;
    }
?>
<div class="card">
    <div class="card-header">
      <strong>View </strong> News
    </div>
    <div class="card-body card-block">
      
      <input type="text" name="news_id" style="display:none" value="{{ $news->id }}">
        <div class="row form-group">
          <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Category: {{ $category }}</label></div>
        </div>
        <div class="row form-group">
        <p style="font-size: 30px; color:rgb(0,0,0); margin: 0 auto;">
        <strong>{{ $news->title }}</strong> </p>
        </div>
        <div class="row form-group" style="width:1200px; margin: 0 auto;">
        <div>{!! html_entity_decode($news->content) !!}</div>
          
        </div>
    </div>
 </div> 

 
 <div class="card">
    <div class="card-header">
    Comments
    </div>
    <div class="card-body card-block" style = "border-bottom: 0.5px solid rgba(0,0,0,.125);">
    <?php
    $comment_arr = Comment::where('news_id','=', $news->id)
                            ->where('status','=','approved')
                            ->join('member','member.id','=','comments.user_id')->get();
    foreach ($comment_arr as $comment) {
        echo $comment->content;
        echo '<p><i>Posted by: '.$comment->member_name.'</i></p><hr>';   
    }
    ?>
    </div>
 </div> 

<div class="card">
    <div class="card-header">
    Pending comments
    </div>
    <div class="card-body card-block" style = "border-bottom: 0.5px solid rgba(0,0,0,.125);">
    <?php
    $comment_arr = Comment::where('news_id','=', $news->id)
                            ->where('status','=','pending')
                            ->join('member','member.id','=','comments.user_id')->get();
    foreach ($comment_arr as $comment) {
        echo $comment->content;              
        echo '<button onclick="confirmDelete('.$comment->comment_id.');" class="btn btn-danger btn-sm"  style="float:right">
        <i class="fa fa-trash-o"></i>&nbsp;Delete</button>';
        echo '<button onclick="approve('.$comment->comment_id.');" class="btn btn-success btn-sm" style="float:right; margin-right:10px">
        <i class="fa fa-dot-circle-o"></i> Approve </button>';
        echo '<p><i>Posted by: '.$comment->member_name.'</i></p><hr>';  
        
    }
    ?>

    </div>
 </div>

 <div class="card">
    <div class="card-header">
    Add new comment
    </div>
    <div class="card-body card-block" style = "border-bottom: 0.5px solid rgba(0,0,0,.125);">
    <textarea id='new_comment' rows="4" cols="100"></textarea>
    <br>
    <button onclick="addComment();" class="btn btn-success btn-sm" style="float:left">
            <i class="fa fa-dot-circle-o"></i> Add
        </button>
    </div>
 </div> 

 <script>
    function addComment() {
        var comment = document.getElementById('new_comment').value;
        window.location.href = window.location.href + '/addcomment?content=' + comment;
    }
    function approve(id) {
        window.location.href = window.location.href + '/approve/' + id;
    }
    function confirmDelete(id) {
        if(confirm('Are you sure to delete?')) {
            window.location.href =  window.location.href + "/deletecomment?id=/" + id;
        }
        else {
           alert('Item is not deleted!');
        }
    }
 </script>
@endsection