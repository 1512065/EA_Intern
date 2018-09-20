
@extends('layout.layout')
@section('title', 'Edit Category')
@section('content')

@if(Session::has('message'))
    <div style="width: 250px; margin: 10px 20px; background-color: rgb(49, 106, 170); height:30px;">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif

<div class="card" style="width: 900px; margin: 0 auto" id="cat_table">
    <div class="card-header">
        <strong class="card-title">All category</strong>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category name</th>
                <th scope="col">Edit name</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
                // get data
                use App\Models\Category;
                $allcat = Category::all();
                foreach ($allcat as $cate) {
                    echo '<tr>';
                    echo '<th scope="row">'.$cate->id.'</th>';
                    echo '<td>'.$cate->name.'</td>';
                    echo '<td id="edit'.$cate->id.'"><a onclick="showEdit('.$cate->name.')"><i class="fa fa-pencil"></i></a></td>';
                    echo '<td><a href="category/delete/'.$cate->id.'"><i class="fa fa-trash-o"></i></a></td>';
                    echo '</tr>';
                }
            ?>            
            </tbody>
        </table>

    </div>
</div>
@endsection

<script>
function showEdit(id) {
   
}
</script>

