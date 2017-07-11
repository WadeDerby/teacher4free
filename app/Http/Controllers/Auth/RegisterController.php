<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Teacher;
use App\Organization;
use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function registerTeacher(Request $request)
    {
        return Teacher::create([
            'name' => $request['name'], 
            'institution' =>$request['inst'] , 
            'date_of_birth' =>$request['dob'] , 
            'email' =>$request['email'] , 
            'phone' => $request['phoneNo'], 
            'skills' => $request['skills'], 
            'username' => $request['username'], 
            ]);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function registerSchool(Request $request)
    {
        return School::create([
            'name' => $request['name'],
            'location' => $request['location'],
            'age' => $request['age'],
            'username' => $request['username'],

            ]);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function registerOrganization(Request $request)
    {
        return Organization::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'email' => $request['email'],

            ]);
    }
}
