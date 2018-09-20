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

        Route::get('/login', ['as' => 'member.login', 'uses' => 'AuthController@getLogin']);
        Route::post('/login', [ 'uses' => 'AuthController@postLogin']);
        Route::get('/logout', [ 'uses' => 'AuthController@getLogout']);
        Route::get('/addcategory', function(){ 
            return view(
                'Backend::page.category.add',[]
            );
        });

        Route::post('/addcategory', [ 'uses' => 'CategoryController@addCategory']);

        Route::get('/editcategory', function(){
            return view(
                'Backend::page.category.edit',[]
            );
        });

        Route::get('category/delete/{id}', [ 'uses' => 'CategoryController@deleteCategory']
        )->where('id','[0-9]+');

        Route::get('category/edit/{id}', [ 'uses' => 'CategoryController@editCategory']
        )->where('id','[0-9]+');


    }
);