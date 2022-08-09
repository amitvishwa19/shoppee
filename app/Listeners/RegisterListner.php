<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterListner
{

    public function __construct()
    {
        //
    }


    public function handle(RegisterEvent $event)
    {
        activity()->log('New user registered');

        $to = $event->email;
        $subject = 'Welcome to '. setting('app_name') . ' please activate your account';
        $body = 'test body';
        $data = $data = array(
            'username' => $event->username,
            'email' => $event->email,
            'verification_code' => $event->verification_code
        );
        $view = 'mails.register';


        return appmail($to,$subject,$body,$data,$view,true);
    }
}
