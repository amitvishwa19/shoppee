<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $email;
    public $verification_code;

    public function __construct($user)
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->verification_code = $user->verification_code;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
