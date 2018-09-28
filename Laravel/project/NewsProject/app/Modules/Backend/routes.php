<?php

Route::group(
    [
        'namespace'=>'App\Modules\Backend\Controllers',
        'middleware' => ['web']
    ], function(){

        Route::get('/', function () {
            return view(
                'Backend::page.home',
                []
            );
        })->middleware(['member_auth']);

        // Log in, log out
        Route::get('/login', ['as' => 'member.login', 'uses' => 'AuthController@getLogin']);
        Route::post('/login', [ 'uses' => 'AuthController@postLogin']);
        Route::get('/logout', [ 'uses' => 'AuthController@getLogout']);
        //////////////////
        // Category
        Route::get('category', function(){
            return view(
                'Backend::page.category.index',[]
            );
        });
        //relation
        Route::get('/relation', function(){
            return view(
                'Backend::page.category.relation',[]
            );
        });
        // search
        Route::get('category/filter', [ 'uses' => 'CategoryController@filterCategory']
        );
        // ad
        Route::get('/addcategory', function(){ 
            return view(
                'Backend::page.category.add',[]
            );
        });
        Route::post('/addcategory', [ 'uses' => 'CategoryController@addCategory']);
        // delete
        Route::get('/category/delete/{id}', [ 'uses' => 'CategoryController@deleteCategory']
        )->where('id','[0-9]+');
        // edit
        Route::get('category/edit/{id}', function($id){
            return view(
                'Backend::page.category.edit', ['id' => $id]
            );
        }
        )->where('id','[0-9]+');
        Route::post('category/edit/{id}', ['uses' => 'CategoryController@editCategory']
        )->where('id','[0-9]+');
        ////////////////////
        // News
        Route::get('/news', function(){
            return view(
                'Backend::page.news.index',[]
            );
        });
        // add
        Route::get('/addnews', function(){ 
            return view(
                'Backend::page.news.add',[]
            );
        });
        Route::post('/addnews', [ 'uses' => 'NewsController@addNews']);
        // delete
        Route::get('/news/delete/{id}', [ 'uses' => 'NewsController@deleteNews']
        )->where('id','[0-9]+');
        //edit
        Route::get('news/edit/{id}', function($id){
            return view(
                'Backend::page.news.edit', ['id' => $id]
            );
        }
        )->where('id','[0-9]+');
        Route::post('news/edit/{id}', ['uses' => 'NewsController@editNews']
        )->where('id','[0-9]+');
        // view + show comment
        Route::get('news/{id}', function($id){
            return view(
                'Backend::page.news.view', ['id' => $id]
            );
        }
        )->where('id','[0-9]+');
        //filter
        Route::get('news/filter', [ 'uses' => 'NewsController@filterNews']
        );

        // add comment
        Route::get('news/{id}/addcomment', [ 'uses' => 'NewsController@addComment']
        )->where('id','[0-9]+');

        //approve
        Route::get('news/{id}/approve/{cmt_id}', [ 'uses' => 'NewsController@approveComment']
        )->where('id','[0-9]+')->where('cmt_id','[0-9]+');
        //delete
        Route::get('news/{id}/deletecomment', [ 'uses' => 'NewsController@deleteComment']
        )->where('id','[0-9]+');

    }
);