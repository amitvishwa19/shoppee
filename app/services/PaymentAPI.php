<?php

namespace App\Services;


class PaymentAPI{

    private $transactionId;

    public function __construct($transactionId){
        $this->transactionId = $transactionId;

    }

    public function pay(){
        return [
            'amount'=> 'all',
            'transactionId' =>  $this->transactionId
        ];
    }


}
