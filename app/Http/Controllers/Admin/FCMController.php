<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Fcm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FirebaseMessaging;
use App\Http\Controllers\Controller;

class FCMController extends Controller
{
    public function __construct(){


    }

    public function index()
    {
        activity('Git Pull')->log('Git pull from github');
        // $notification = FCM::SendNotification(
            
        // );
        // dd($notification);
        return view('admin.pages.fcm.fcm');
    }

    public function send_message(Request $request){


        $fcm = new FirebaseMessaging;
        $fcm->title =  $request->title;
        $fcm->body = $request->body;
        $fcm->data = array
        (
            'message'   => 'data-1',
            'productId' => '632180',
        );
        $fcm->users =  User::whereNotNull('fcm_device_id')->pluck('fcm_device_id')->all();
        $fcm->send();


        return redirect() ->route('fcm')
        ->with([
            'message'    =>'Notification sent Successfully',
            'alert-type' => 'success',
        ]);
    }

    
}
