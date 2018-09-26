
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
    @include('layout.filter')
    
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"># <i class="fa fa-sort" style="margin-left: 5px;" onclick="sort('id')"></i></th>
                <th scope="col">Category name <i class="fa fa-sort" style="margin-left: 5px;" onclick="sort('name')"></i></th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
                 //get data
                use App\Models\Category;
             
                $limit = Category::getLimit();
                
                if (!isset($rows)) {
                    $allcat = Category::all()->take($limit);
                    $rows= $allcat;
                }
                
                foreach ($rows as $cate) {
                    echo '<tr>';
                    echo '<th scope="row">'.$cate->id.'</th>';
                    echo '<td>'.$cate->name.'</td>';
                    echo '<td><a href="category/edit/'.$cate->id.'"><i class="fa fa-pencil"></i></a></td>';
                    echo '<td><a onclick="confirmDelete('.$cate->id.')"><i class="fa fa-trash-o"></i></a></td>';
                    echo '</tr>';
                }

                if (!isset($count)) {
                    $all = Category::all();
                    $count = $all->count();
                }
   
            ?>            
            </tbody>
        </table>

    </div>
</div>

<div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table_paginate" style="margin: 0 auto;">
<ul class="pagination">
<li class="paginate_button page-item previous" id="bootstrap-data-table_previous">
<a href="#" aria-controls="bootstrap-data-table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
</li>
<li class="paginate_button page-item " id='clone' onclick="changePage(this);" style="display:none"><a  aria-controls="bootstrap-data-table" class="page-link"></a></li>
<li class="paginate_button page-item next" id="bootstrap-data-table_next"><a href="#" aria-controls="bootstrap-data-table" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
</ul>
</div>

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
var param = {!! json_encode($_GET) !!};
function confirmDelete(id) {
    if(confirm('Are you sure to delete?')) {
      
        window.location.href =  window.location.href + "/delete/" + id;
    }
    else alert('Item is not deleted!');
}
function changePage(elm) {
    debugger;
        var new_page = parseInt(elm.innerText,10);
        //check recent page is clicked?
        if (typeof(param['page'])!=='undefined') {
            if (param['page']!= new_page) {
                param['page']= new_page;
                var query = $.param(param);
                window.location.search = '?' + query;
            } 
        } else {
            if (window.location.search == "") {
                window.location.href = window.location.href + '/filter?page=' + new_page;
            } else {
                window.location.href = window.location.href + '&page=' + new_page;
            }
        }
    }
$(document).ready(function(){
    function generatePages() {
       
        var num = {{$count}};
        var limit = $('#limit').val();
        var page_count  = Math.floor(num / limit) +1;
        for (let i=page_count; i>0; i--) {
            var clone = $('#clone').clone();
            var a = clone.find('a').html(i);
            clone.attr("id",'page' + i);
            clone.css("display","");
            clone.insertAfter($('#clone'));
        }
    }
    generatePages();
    //active recent page
    
    if (typeof(param['page'])=='undefined') {
        $('#page1').addClass('active');
    } else {
        var page = param['page'];
        $('#page'+page).addClass('active');
    }

    
});

</script>

