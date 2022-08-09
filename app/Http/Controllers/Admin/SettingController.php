<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    //protected $settings = [];


    public function __construct(){

    }

    public function index(Request $request)
    {
        \AppSetting::get('app_name');

        //dd($settings->get('name'));
        //dd($settings->all());

        //return Setting::get();
        //Setting::set('app_name','devlomatix2');
        return view('admin.pages.setting.setting');

    }

    // public function create()
    // {
    //     return view('admin.pages.setting.setting');
    // }

    public function store(Request $request)
    {
        //dd($request->get('type'));
        
        if($request->get('type') == 'profile'){
            $this->updateProfile($request);
        }

        if($request->get('type') == 'password'){
            $this->changePassword($request);
        }
        
        setting('app_name',$request->app_name);
        setting('app_description',$request->app_description);

        if($request->file('app_icon')){
            $auth_image_url = uploadImage($request->file('app_icon'));
            setting('app_icon',$auth_image_url);
        }

        if($request->file('app_fevicon')){
            $auth_image_url = uploadImage($request->file('app_fevicon'));
            setting('app_fevicon',$auth_image_url);
        }

        if($request->file('auth_image')){
            $auth_image_url = uploadImage($request->file('auth_image'));
            setting('auth_image_url',$auth_image_url);
        }
     

        // return redirect()->route('setting.index')
        // ->with([
        //     'message'    =>'Setting Saved Successfully',
        //     'alert-type' => 'success',
        // ]);

        return redirect()->back()
        ->with([
            'message'    =>'Setting Saved Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function updateProfile($request){
        //dd($request->all());

        $validate = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
        ]);
        
        $user = User::findOrFail( auth()->user()->id);
        $user->firstName = $request->firstname;
        $user->lastName = $request->lastname;
        $user->save();


    }

    public function changePassword($request){
        //dd('change password');
        $validate = $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
        ]);

        $user = User::findOrFail( auth()->user()->id);
        $user->password = Hash::make($request->new_password);;
        $user->save();


    }
    
}
