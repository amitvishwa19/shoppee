<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AutoDeployController extends Controller
{
    public function deploy(Request $request)
    {
        activity()->log('Webhook from github ,will fire this event if new push to github');

        Artisan::call('git:pull');
        return response()->json(['message'=>'Successfully delivered notification'],200);
    }

    public function gitDeploy(Request $request){

        return 'Git Deploy';

    }
}
