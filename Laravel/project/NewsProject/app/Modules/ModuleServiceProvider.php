<?php   namespace App\Modules;
 
use Illuminate\Support\ServiceProvider;
 
class ModuleServiceProvider extends ServiceProvider{
 
    public function register(){
 
    }
 
    public function boot(){
        //Load file config/module.php
        $modules = config('module');
 
        $mod = $modules['frontend']['folder_name'];
        $base_url = request()->getBaseUrl();
 
        $backend_slug = $modules['backend']['slug_name'];
 
        //base url end with admin or admin/
        $pattern = '/(\/'.$backend_slug.'|\/'.$backend_slug.'\/)$/';
        if(preg_match($pattern, $base_url, $match)) {
            $mod = $modules['backend']['folder_name'];
        }
 
        //Load file routes.php tuong ung cua tung module
        if(file_exists(__DIR__ . '/' . $mod . '/routes.php')){
            include __DIR__ . '/' . $mod . '/routes.php';
        }
 
        //Load cac file template tuong ung trong tung module
        if(is_dir(__DIR__ . '/' . $mod . '/Views')){
            $this->loadViewsFrom(__DIR__ . '/' . $mod . '/Views', $mod);
        }
    }
}