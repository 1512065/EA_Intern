
@extends('layout.layout')
@section('title', 'Category')
@section('content')

@if(Session::has('message'))
    <div style="margin: 10px 20px; background-color: rgb(49, 106, 170);">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif

<div class="card" id="cat_table">
    <div class="card-header">
        <strong class="card-title">All category</strong>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
                // get data
                use App\Models\Category;
                $allcat = Category::all()->sortBy('id');
                foreach ($allcat as $cate) {
                    echo '<tr>';
                    echo '<th scope="row">'.$cate->id.'</th>';
                    echo '<td>'.$cate->name.'</td>';
                    echo '<td><a href="category/edit/'.$cate->id.'"><i class="fa fa-pencil"></i></a></td>';
                    echo '<td><a onclick="confirmDelete('.$cate->id.')"><i class="fa fa-trash-o"></i></a></td>';
                    echo '</tr>';
                }
            ?>            
            </tbody>
        </table>

    </div>
</div>
<div class="card" id="cat_table" style="margin-top: 10px;">
    <div class="card-header">
        <strong class="card-title">Relation</strong>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Parent</th>
                <th scope="col">Child</th>
            </tr>
            </thead>
            <tbody>
            <?php
               use App\Models\Category_Group;
               $all_rel = Category_Group::all()->sortBy('parent_id');
               $old_parent= -1;
               foreach ($all_rel as $relation) {
                echo '<tr>';
                $parent = Category::find($relation->parent_id);
                if ($relation->parent_id != $old_parent) {
                    echo '<td>'.$parent->name.'</td>';
                } else {
                    echo '<td></td>';
                }
                $child = Category::find($relation->cat_id);
                echo '<td>'.$child->name.'</td>';
                echo '</tr>';
                $old_parent = $relation->parent_id;
               }

            ?>            
            </tbody>
        </table>

    </div>
</div>
@endsection

<script>
function confirmDelete(id) {
    if(confirm('Are you sure to delete?')) {
        debugger;
        window.location.href =  window.location.href + "/delete/" + id;
    }
    else alert('Item is not deleted!');
}
</script>

