<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Devlearn\DevlearnController;


Route::get('/',[DevlearnController::class,'dashboard'])->name('devlearn.dashboard');

