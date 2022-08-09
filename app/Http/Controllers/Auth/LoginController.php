<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // protected function authenticated(Request $request, $user)
    // {
    //     //dd($user);
    //     // if($user->role=='super_admin'){
    //     //     return redirect()->route('admin.dashboard') ;
    //     // }elseif($user->role=='brand_manager'){
    //     //     return redirect()->route('brands.dashboard') ;
    //     // }
    // }

    public function credentials(Request $request)
    {

        //return $request->only($this->username(), 'password', 'status' => 1);
        //return array_merge($request->only($this->username(), 'password',['status' => 1]));
        return ['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>'1'];
    }

}
