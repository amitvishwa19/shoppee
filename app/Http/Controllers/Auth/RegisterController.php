<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Events\RegisterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'username' => ['required', 'string','max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    // protected function create(array $data)
    // {

    //     $user =  User::create([
    //         'username' => $data['username'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'verification_code' => sha1(time()),
    //     ]);

    //     if($user != null){
    //         event(new RegisterEvent($user));
    //         return redirect()->back()->with(session()->flash('register_success','Account created successfully,please check your mail for activation code'));
    //     }


    //     return redirect()->back()->with(session()->flash('alert','account not created, please try again'));
    // }

    public function register(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());
        $user->save();


        if($user != null){
            event(new RegisterEvent($user));
            return redirect()->back()->with(session()->flash('register_success','Account created successfully,please check your mail for activation code'));
        }
        return redirect()->back()->with(session()->flash('register_alert','account not created, please try again'));
    }

    public function verifyUser(Request $request){

        //dd($request->code);
        $verification_code = $request->code;
        $user = User::where(['verification_code' => $verification_code])->first();

        if($user != null){
            $user->status = 1;
            $user->verification_code = null;
            $user->save();
            return redirect()->route('login')->with(session()->flash('verified','Your account is verified successfully, please login to continue'));
        }else{
            return redirect()->route('login')->with(session()->flash('invalid_token','Invalid verification code'));
        }


    }

}
