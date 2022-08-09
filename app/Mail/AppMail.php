<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppMail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;
    public $body;
    public $data;
    public $view;

    public function __construct($subject,$body,$data,$view)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('info@devlomatix.com','Devlomatix Solutions')
            ->subject( $this->subject)
            ->view($this->view);
    }
}
