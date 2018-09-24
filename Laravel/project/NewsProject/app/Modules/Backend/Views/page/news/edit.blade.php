
@extends('layout.layout')
@section('title', 'Edit News')
@section('content')

@if(Session::has('message'))
    <div style="margin: 10px 20px; background-color: rgb(49, 106, 170);">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif
 <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<?php
    // get data 
    use App\Models\News;
    use App\Models\News_Category;
    $news = News::find($id);
    $relation = News_Category::where('news_id','=', $id)->get()->toArray();
   
?>
 <div class="card">
    <div class="card-header">
      <strong>Edit </strong> News
    </div>

    <div class="card-body card-block">
      <form action="{{ Request::url() }}" method="post" enctype="multipart/form-data" class="form-horizontal">
      {!! csrf_field() !!}
      <input type="text" name="news_id" style="display:none" value="{{ $news->id }}">
        <div class="row form-group">
          <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Category</label></div>
          <div class="col-12 col-md-9">
          <?php
            // get data to combo-box
            use App\Models\Category;
            $allcat = Category::all();
            $count = $allcat->count();
            $recent = 0;
            echo '<div style="width:200px; display:inline-block;">';
            foreach ($allcat as $cate) {
              
              if ($recent % 5 ==0 && $recent!=0) {
                echo '</div>';
                if ($recent <$count && $recent!=0) {
                  echo '<div style="width:200px; display:inline-block;">';
                }
              }
              echo '<input type="checkbox" id ="'.$cate->id.'" name="category[]" value="'.$cate->id.'">&nbsp;'.$cate->name.'<br>';
              $recent++;
            }
            echo '</div>';
          ?>
          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="text-input" class=" form-control-label">News's Title</label></div>
          <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Title" value="{{ $news->title }}" class="form-control"></div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">News's content</label></div>
         
          <div class="col-12 col-md-9"> 
          <textarea name="content">{!! html_entity_decode($news->content) !!}</textarea>
        <script>
          CKEDITOR.replace( 'content' );
        </script></div>
        </div>
        </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm" style="float:right;">
          <i class="fa fa-dot-circle-o"></i> Submit changes
        </button>
      </div>
    
      </form>
      <!--BUTTON-->
      </div> 
<script>
    cate_arr = {!! json_encode($relation) !!};
    for (let i=0; i< cate_arr.length; i++) {
        document.getElementById(cate_arr[i].cat_id).checked =true;
    }
    
</script>
@endsection