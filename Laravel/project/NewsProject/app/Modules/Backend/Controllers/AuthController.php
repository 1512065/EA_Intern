<?php   namespace App\Modules\Backend\Controllers;

use Auth;
use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class AuthController extends Controller{

    use DispatchesJobs, ValidatesRequests;


    private $guard;

    const BASE_URL = '/';

    public function __construct(){
        $this->guard = Auth::guard('member');
    }

    public function getLogin(Request $request){

        return view(
            'Backend::member.login',
            []
        );
    }

    public function postLogin(Request $request){

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        
        $remember_me = false;
        if($request->has('remember_me') && $request->input('remember_me') == 1)
            $remember_me = true;

        if($this->guard->attempt($credentials, $remember_me)){
            $admin = $this->guard->user();
            if($admin->active == 0){
                $this->guard->logout();
                return redirect(self::BASE_URL . 'login')->with('message-error', 'Account is not actived.');
            }
          
            return redirect(self::BASE_URL);
        }


        return redirect()->route('member.login')->with('message-error', 'The credentials is not found.');

    }

    public function getLogout(){
        $this->guard->logout();
        session()->flush();
        return redirect()->guest(self::BASE_URL . 'login');
    }
}