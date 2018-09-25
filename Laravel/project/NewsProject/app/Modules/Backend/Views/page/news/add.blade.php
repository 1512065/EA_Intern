
@extends('layout.layout')
@section('title', 'Add News')
@section('content')

@if(Session::has('message'))
    <div style="width: 250px; margin: 10px 20px; background-color: rgb(49, 106, 170); height:30px;">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif
 <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
 <div class="card">
    <div class="card-header">
      <strong>Create </strong> News
    </div>

    <div class="card-body card-block">
      <form action="{{ Request::url() }}" method="post" enctype="multipart/form-data" class="form-horizontal">
      {!! csrf_field() !!}
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
              echo '<input type="checkbox" name="category[]" value="'.$cate->id.'">&nbsp;'.$cate->name.'<br>';
              $recent++;
            }
            echo '</div>';
          ?>
          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="text-input" class=" form-control-label">News's Title</label></div>
          <div class="col-12 col-md-9"><input type="text" id="title" name="title" placeholder="Title" class="form-control"></div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">News's content</label></div>
          <div class="col-12 col-md-9"> <textarea name="content"></textarea>
		<script>
			CKEDITOR.replace( 'content' );

		</script></div>
        </div>
<!--BUTTON-->
      
        <button type="submit" class="btn btn-primary btn-sm" style="float:right;">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
        <button class="btn btn-danger btn-sm" type="reset" style="float:right; margin-right: 10px;">
          <i class="fa fa-ban"></i> Reset
        </button>
      
    </div>
      </form>
      
      </div> 

@endsection