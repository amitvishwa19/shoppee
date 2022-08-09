<?php

namespace App\Listeners;

use App\Events\InquiryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InquiryListner
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
     * @param  InquiryEvent  $event
     * @return void
     */
    public function handle(InquiryEvent $event)
    {
        $to = $event->email;
        $subject = 'Inquiry for Devlomatix :: ' . $event->subject;
        $body = 'test body';
        $data = array(
                    'name' => $event->name,
                    'message' => $event->message
                );
        $view = 'mails.inquiry';
        return appmail($to,$subject,$body,$data,$view,true);


    }
}
