<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Devcomm\DevcommAdminController;


//Route::get('/',[DevcommAdminController::class,'dashboard'])->name('devcomm.dashboard');
Route::resource('/product',ProductController::class);
