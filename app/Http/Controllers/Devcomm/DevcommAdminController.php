<?php

namespace App\Http\Controllers\Devcomm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevcommAdminController extends Controller
{
    

    public function dashboard(){

        return view('devcomm.admin.pages.dashboard.dashboard');
    }
}
