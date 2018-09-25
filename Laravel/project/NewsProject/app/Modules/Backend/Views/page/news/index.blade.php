
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
    @include('layout.sort')
        <table class="table" id="news_tbl">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">News Title<i class="fa fa-sort"  onclick="sortTable(0);" style="margin-left: 5px;"></i></th>
                <th scope="col">Created date<i class="fa fa-sort"  onclick="sortTable(1);" style="margin-left: 5px;"></i></th>
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
                    $allnews = News::all()->take(10);
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
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch;
  var switchcount = 0;
  table = document.getElementById("news_tbl");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
     
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    }
    if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
    }
  }
}
</script>

