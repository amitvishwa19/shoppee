<?php

namespace App\Services\Aws;

use Aws\Sdk;
use Aws\Resource\Aws;


class AwsService{

    public $aws;

    public function __construct()
    {
        //$config = config('aws');
        //$this->aws = new Sdk($config);
    }

    public function access_key()
    {
        $config = config('aws');
        return $config;
    }


    public function s3()
    {
        //$s3 = $this->aws->s3;

    }





}
