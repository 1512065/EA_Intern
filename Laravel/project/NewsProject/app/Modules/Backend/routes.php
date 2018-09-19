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
    }
);