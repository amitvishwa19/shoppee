<?php

namespace App\Jobs;

use App\Mail\AppMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MailerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $to;
    public $subject;
    public $body;
    public $data;
    public $view;



    public function __construct($to,$subject,$body,$data,$view)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->view = $view;
        $this->data = $data;
    }


    public function handle()
    {
        Mail::to($this->to)->send(new AppMail($this->subject,$this->body,$this->data,$this->view));
    }
}
