<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User as User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function index(){
        return view('auth.login');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function login(Request $request){
        $user = User::where('username',$request["user"])->get();
        if($user->count() < 1){
            $string = 'Username invalid';
            return $string;
        }elseif ($user->count() > 0) {
            if(Hash::check($request['pass'],$user[0]->password)){
                $authUser = User::find($user[0]->id);
                Auth::login($authUser, true);
                return redirect('/login');
            }else{
                $string = 'Wrong password';
                return $string;
            }
        }else{
            $string = 'Try signing up';
            return $string;
        }
        
    }


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
