<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Facebook\Facebook;
use App\Models\Profile;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct(){


    }

    public function store(Request $request)
    {
        //return ['status' =>200];
        $input = $request->all();
        $rule = [
            'firstname' => 'required',
            'lastname' => 'required'
        ];
        $validator = Validator::make($input,$rule);
        
        if($validator->fails()){
            return ['status'=> 400, 'msg'=>$validator->errors()->first()];
        }else{
            try{
                $user = User::findOrFail(auth()->user()->id);
                $user->firstName = $request->firstname;
                $user->lastName = $request->lastname;
                $user->username = $request->username;
                $user->save();
                return ['status' =>200,'msg'=>'Profile updated successfully'];
            }catch(Exception $ex){
                return ['status'=> 400, 'msg'=>$validator->errors()->first()];
            }
            
        }
    }

    public function facebookRedirect(){

        //return config('services.facebook.client_id');


        return Socialite::driver('facebook')->scopes([
            "public_profile", "pages_show_list", "pages_read_engagement", "pages_manage_posts", "pages_manage_metadata", "user_videos", "user_posts"
        ])->redirect();

        
    }

    public function facebookCallback(){

        //return 'facebook callback';
        $auth_user = Socialite::driver('facebook')->user();
        //dd($auth_user);
        DB::table('users')
            ->where('id',auth()->user()->id)
            ->update([
                'facebook_token'=>$auth_user->token,
                'facebook_app_id'=>$auth_user->id,
                'avatar_url' => $auth_user->avatar,
            ]);
        return redirect()->to(route('setting.index',['type'=>'facebook']));
    }

    
}
