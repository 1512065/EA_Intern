<?php 
namespace App\Modules\Backend\Middleware;
use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class MemberAuthentication{

    //Refer to the admin guard from the config/auth.php
    protected $guard;

    public function __construct(){
        //Get the admin guard
        $this->guard = Auth::guard('member');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $base_url = $request->getBaseUrl();

        //base url end with admin or admin/
        if(preg_match('/(\/admin|\/admin\/)$/', $base_url, $match)){

            //From version 5.3
            $this->guard->authenticate();

            return $next($request);
        }

        return $next($request);
    }
}