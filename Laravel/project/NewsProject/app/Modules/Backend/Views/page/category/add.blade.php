
@extends('layout.layout')
@section('title', 'Add Category')
@section('content')

@if(Session::has('message'))
    <div style="width: 250px; margin: 10px 20px; background-color: rgb(49, 106, 170); height:30px;">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif
<div style="width: 700px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <strong>Create New</strong> Category
        </div>
        <div class="card-body card-block" style="width: 650px; margin: 0 auto;">
        <form class="form-horizontal" method="POST" action="{{ Request::url() }}">
        {!! csrf_field() !!}
         <div class="row form-group">
            Catory name: <br>
            <input type="text" id="new_category" name="new_category" placeholder="Text" class="form-control">
            <br>Parent group: <br>
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
        <button type="submit" class="btn btn-success btn-sm" style="float:right">
            <i class="fa fa-dot-circle-o"></i> Add
        </button>
        </form>
        </div>
       
    </div>
</div>

@endsection