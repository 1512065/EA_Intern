
@extends('layout.layout')
@section('title', 'News')
@section('content')

@if(Session::has('message'))
    <div style="width: 250px; margin: 10px 20px; background-color: rgb(49, 106, 170); height:30px;">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif

<div class="card" id="cat_table">
    <div class="card-header">
        <strong class="card-title">All News</strong>
    </div>
  
    <div class="card-body">
    @include('layout.filter')

        <table class="table" id="news_tbl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">News Title<i class="fa fa-sort"  onclick="sort('title');" style="margin-left: 5px;"></i></th>
                <th scope="col">Created date<i class="fa fa-sort"  onclick="sort('created_at');" style="margin-left: 5px;"></i></th>
                <th scope="col">Category</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
                // get data
                use App\Models\News;
                use App\Models\News_Category;
                use App\Models\Category;
               // $allnews = News::all();
                if (!isset($rows)) {
                   
                    $limit = News::getLimit();
                    
                    $allnews = News::all()->take($limit);
                    $rows= $allnews;
                }
                $relation = News_Category::all()->sortBy('news_id');
                foreach ($rows as $news) {
                    echo '<tr>';
                    echo '<th scope="row">'.$news->id.'</th>';
                    echo '<td><a href="news/'.$news->id.'">'.$news->title.'</a></td>';
                    echo '<td>'.$news->created_at.'</td>';
                    echo '<td><select id="'.$news->id.'" class="form-control">';
                    $relation = News_Category::where('news_id','=', $news->id)->get()->toArray();
                    foreach ($relation as $record) {
                        $cat_id = $record['cat_id'];
                        $category = Category::find($cat_id);
                        echo '<option>'.$category->name.'</option>';
                    }         
                    echo '</select></td>';
                    echo '<td><a href="news/edit/'.$news->id.'"><i class="fa fa-pencil"></i></a></td>';
                    echo '<td><a onclick="confirmDelete('.$news->id.')"><i class="fa fa-trash-o"></i></a></td>';
                    echo '</tr>';
                }

                if (!isset($count)) {
                    $all = News::all();
                    $count = $all->count();
                }
   
            ?>            
            </tbody>
        </table>

    </div>
</div><div class="dataTables_paginate paging_simple_numbers" id="bootstrap-data-table_paginate" style="margin: 0 auto;">
<ul class="pagination">
<li class="paginate_button page-item previous" id="bootstrap-data-table_previous">
<a onclick="prevPage();" aria-controls="bootstrap-data-table" class="page-link">Previous</a>
</li>
<li class="paginate_button page-item " id='clone' onclick="changePage(this);" style="display:none"><a  aria-controls="bootstrap-data-table" class="page-link"></a></li>
<li class="paginate_button page-item next" id="bootstrap-data-table_next"><a onclick="nextPage();" aria-controls="bootstrap-data-table" class="page-link">Next</a></li>
</ul>
</div>@endsection



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
        } 
        else 
        {
            window.location.href = window.location.href + '&page=' + new_page;
        }
    }
}
function nextPage(){
    if (typeof(param['page'])=='undefined') {
        $('#page2').click();
    } else {
        var page = param['page'];
        var new_page= 1 + parseInt(page,10);
        $('#page' + new_page).click();
    }
}
function prevPage(){
    if (typeof(param['page'])!=='undefined') {
    
        var page = param['page'];
        var new_page= parseInt(page,10)-1;
        $('#page' + new_page).click();
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
