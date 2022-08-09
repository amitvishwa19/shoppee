<?php

namespace App\Services;

use App\Mail\AppMail;
use App\Jobs\MailerJob;
use Illuminate\Support\Facades\Mail;




class AppMailingService
{

    public $subject;
    public $body;

    // public function __construct($subject,$body)
    // {
    //     $this->subject = $subject;
    //     $this->body = $body;
    // }

    public function test(){
        activity()->log('App mail service provider');

        $to = 'jaysvishwa@gmail.com';
        $subject = 'Test Mail Subject';
        $body = 'test body';
        $data = 'test data';
        $view = 'mails.testmail';
        Mail::to($to)->send(new AppMail($subject,$body,$data,$view));


        return 'AppMail';
    }

    public function SendMail($to,$subject,$body,$data,$view)
    {
        //activity()->log('App mailing service  sendMail finction ' . 'Subject :- ' . $subject  );
        Mail::to($to)->send(new AppMail($subject,$body,$data,$view));
    }

    public function sendMailJob($to,$subject,$body,$data,$view)
    {
        dispatch(new MailerJob($to,$subject,$body,$data,$view));
    }


}


