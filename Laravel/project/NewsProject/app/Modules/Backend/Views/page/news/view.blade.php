
@extends('layout.layout')
@section('title', 'View News')
@section('content')

@if(Session::has('message'))
    <div style="margin: 10px 20px; background-color: rgb(49, 106, 170);">
    <p style="margin-left: 10px;color:rgb(255, 255, 255);">
    {{ Session::get('message') }}</p>
    </div>
 @endif

<?php
    // get data 
    use App\Models\News;
    use App\Models\News_Category;
    use App\Models\Category;
    $news = News::find($id);
    $relation = News_Category::where('news_id','=', $id)->get()->toArray();
    $category = "";
    foreach ($relation as $record) {
        $cate = Category::find($record['cat_id']);
        $category = ' - '.$cate->name;
    }
?>
<div class="card">
    <div class="card-header">
      <strong>View </strong> News
    </div>
    <div class="card-body card-block">
      
      <input type="text" name="news_id" style="display:none" value="{{ $news->id }}">
        <div class="row form-group">
          <div class="col col-md-3"><label for="selectLg" class=" form-control-label">Category: {{ $category }}</label></div>
        </div>
        <div class="row form-group">
        <p style="font-size: 30px; color:rgb(0,0,0); margin: 0 auto;">
        <strong>{{ $news->title }}</strong> </p>
        </div>
        <div class="row form-group" style="width:1200px; margin: 0 auto;">
        <div>{!! html_entity_decode($news->content) !!}</div>
          
        </div>
    </div>
 </div> 
 <div class="card">
    <div class="card-header">
    Comments
    </div>
    <div class="card-body card-block" style = "border-bottom: 0.5px solid rgba(0,0,0,.125);">
         abc
    </div>
 </div> 
@endsection