<?php

Route::group(
    [
        'namespace'=>'App\Modules\Backend\Controllers',
        'middleware' => ['web']
    ], function(){

        Route::get('/', function () {
            echo "Hello Backend. <a href='" . url('/logout') . "'>Logout</a>";
        });

        Route::get('/login', ['as' => 'admin.login', 'uses' => 'AuthController@getLogin']);
        Route::post('/login', [ 'uses' => 'AuthController@postLogin']);
 
        Route::get('/logout', [ 'uses' => 'AuthController@getLogout']);
    }
);