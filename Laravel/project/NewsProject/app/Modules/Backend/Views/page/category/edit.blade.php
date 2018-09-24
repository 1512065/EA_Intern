
@extends('layout.layout')
@section('title', 'Edit Category')
@section('content')
<?php
    // get data to combo-box
    use App\Models\Category;
    use App\Models\Category_Group;
    $cat = Category::find($id);
    $parent = Category_Group::where('cat_id','=',$id)->get()->first();
    
    //if not find parent
    if (isset($parent->parent_id)){
        $parent_id = $parent->parent_id;
        $p_cat = Category::find($parent_id);
    }
    else {
        $p_cat = new Category_Group;
        $p_cat->name = "None";
        $p_cat->id = "-1";
    }
    ////
    
?>
<div style="width: 700px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <strong>Edit</strong> Category
        </div>
        <div class="card-body card-block" style="width: 650px; margin: 0 auto;">
        <form class="form-horizontal" method="POST" action="{{ Request::url() }}">
        {!! csrf_field() !!}
         <div class="row form-group">
            <input type="text" name="cat_id" style="display:none" value="{{ $cat->id }}">
            Catory name: <br>
            <input type="text" name="new_name" class="form-control" value="{{ $cat->name}}">
            <br>Recent Group: <br>
            <input type="text" name="disabled-input" placeholder="{{ $p_cat->name}}" disabled="" class="form-control">
            <p style="color:rgb(0, 0, 0)">
            <input type="checkbox" name="changebox" id="change" style="margin-top: 5px;"><span>Change parent group</span>
            <br></p>
            <select name="new_parent" id="new_parent" value="{{ $p_cat->id}}" class="form-control" style="display:none">
                <option value="-1">Not change</option>
                <option value="0">No parent</option>
                <?php
                // get data to combo-box
                $allcat = Category::all();
                foreach ($allcat as $cate) {
                    echo '<option value="'.$cate->id.'">'.$cate->name.'</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-sm" style="float:right">
            <i class="fa fa-dot-circle-o"></i> Update
        </button>
        </form>
        </div>
       
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
    jQuery(document).ready(function()
    {
        jQuery('#change').bind("click", function(){
            if(jQuery('#change').prop('checked')===true) {
                jQuery('#new_parent').css("display","");
                
            } else {
                jQuery('#new_parent').css("display","none");
                jQuery('#new_parent').val(-1);
            }
        }); 
    });
</script>
@endsection
