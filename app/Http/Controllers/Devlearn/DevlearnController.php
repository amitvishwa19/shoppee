<?php

namespace App\Http\Controllers\Devlearn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevlearnController extends Controller
{
    public function dashboard(){

        return view('devlearn.admin.pages.dashboard.dashboard');

    }
}
