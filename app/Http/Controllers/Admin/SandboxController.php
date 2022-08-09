<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AppMail;
use App\Mail\TestMail;
use App\Jobs\TestMailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Services\AppMailingService;

class SandboxController extends Controller
{
    public function mail(){

        //$mail->test();
        //dd(app());
        //dd(app()->make('Hello'));
        return view('admin.pages.sandbox.mail');
    }

    public function simpleMail(AppMailingService $mail){


        $to = 'amitvishwa19@gmail.com';
        $from = 'info@devlomatix.com';
        $subject = 'Test mail send by AppMail mailer class,Simple mail without job';
        $body = 'This is the mail body of test mail';
        $data =["title" => "hello", "description" => "test test test"];
        $view = 'mails.testmail';

        //Mail::to('jaysvishwa@gmail.com')->send(new TestMail);
        //$mail = Mail::to($to)->send(new AppMail($subject,$body));

        $mail->sendMail($to,$subject,$body,$data,$view);


        return redirect() ->route('sandbox.mail')
        ->with([
            'message'    =>'Mail sent successfully',
            'alert-type' => 'success',
        ]);
    }

    public function dispatchMail(AppMailingService $mail){
        $to = 'amitvishwa19@gmail.com';
        $from = 'info@devlomatix.com';
        $subject = 'Test mail send by AppMail mailer class,Simple mail with job';
        $body = 'This is the mail body of test mail';
        $data =["title" => "hello", "description" => "test test test"];
        $view = 'mails.wola';

        $mail->sendMailJob($to,$subject,$body,$data,$view);


        return redirect() ->route('sandbox.mail')
        ->with([
            'message'    =>'Mail sent successfully with dispatch job',
            'alert-type' => 'success',
        ]);
    }

    public function dispatchMailCustom(Request $request,AppMailingService $mail)
    {

        $validate = $request->validate([
            'to' => 'required',
        ]);


        $to = $request->to;
        $from = 'info@devlomatix.com';
        $subject = $request->subject;
        $body = $request->message;
        $data = null;
        $view = 'mails.wola';


        $mail->sendMailJob($to,$subject,$body);


        return redirect() ->route('sandbox.mail')
        ->with([
            'message'    =>'Custom Mail sent successfully with dispatch job',
            'alert-type' => 'success',
        ]);

    }
}
