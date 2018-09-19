<?php
 
Route::group(
    [
        'namespace'=>'App\Modules\Frontend\Controllers',
        'middleware' => ['web']
    ], function(){
 
        Route::get('/', function () {
            echo "Hello Frontend. <a href='" . url('/logout') . "'>Logout</a>";
        });

    }
);