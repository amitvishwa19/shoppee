<?php

namespace App\Services;

class FirebaseMessaging{

    public $title;
    public $body;
    public $data=[];
    public $users;






    public function send(){
        
        // $data = array
        // (
        //     'message'   => 'data-1',
        //     'productId' => '632180',
        // );


        $serverKey = config('fcm.server_key');

        $channelId = config('fcm.channel_id');

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $payload = [
            "registration_ids" => $this->users,
            "notification" => [
                "title" => $this->title,
                "body" => $this->body,
                "android_channel_id"=> $channelId,
                "sound"=> "Tri-tone",
                "image"=> "https://ashallendesign.ams3.digitaloceanspaces.com/rMbsGOyK6i1KjNkbXff8qLohzM1nWQA8HNGwHF0J.png",
                "icon" =>"https://ashallendesign.ams3.digitaloceanspaces.com/rMbsGOyK6i1KjNkbXff8qLohzM1nWQA8HNGwHF0J.png",
                "largeIcon"=> "https://ashallendesign.ams3.digitaloceanspaces.com/rMbsGOyK6i1KjNkbXff8qLohzM1nWQA8HNGwHF0J.png",
                "badge"=> "1"
            ],
            'data'=> $this->data,
            'priority'=> 'high'
        ];

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $payload ) );
        $result = curl_exec($ch );
        if ($result === FALSE) 
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close( $ch );
        return $result;


    }

}