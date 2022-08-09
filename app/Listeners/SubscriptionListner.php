<?php

namespace App\Listeners;

use App\Events\SubscriptionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionEvent  $event
     * @return void
     */
    public function handle(SubscriptionEvent $event)
    {
        //activity()->log('Subscription Listner');
        activity()->log($event->email);

        $to = $event->email;
        $subject = 'Newsletter Subscription for '. setting('app_name');
        $body = 'test body';
        $data = $event->email;
        $view = 'mails.subscription';


        //return \AppMail::SendMail($to,$subject,$body,$data,$view);

        return appmail($to,$subject,$body,$data,$view,true);


    }
}
