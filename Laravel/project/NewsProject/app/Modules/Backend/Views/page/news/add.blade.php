
@extends('layout.layout')
@section('title', 'Add News')
@section('content')

@if(Session::has('message'))
    <div style="width: 250px; margin: 10px 20px; background-color: rgb(49, 106, 170); height:30px;">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif
 <div class="card">
                      <div class="card-header">
                        <strong>Create </strong> News
                      </div>
                      <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">News's Title</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="text-input" placeholder="Title" class="form-control"></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">News's content</label></div>
                            <div class="col-12 col-md-9"><textarea name="textarea-input" id="textarea-input" rows="20" placeholder="Content..." class="form-control"></textarea></div>
                          </div>
                          
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Category</label></div>
                            <div class="col-12 col-md-9">
                              <select name="new_parent" id="new_parent" class="form-control">
                                    <option value="0">None</option>
                                <?php
                                    // get data to combo-box
                                    use App\Models\Category;
                                    $allcat = Category::all();
                                    foreach ($allcat as $cate) {
                                        echo '<option value="'.$cate->id.'">'.$cate->name.'</option>';
                                    }
                                ?>
                            </select>
                            </div>
                          </div>
               
          </form>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                    </div>

@endsection