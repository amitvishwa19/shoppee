<?php

use App\Http\Controllers\Devlearn\DevlearnController;
use Illuminate\Support\Facades\Route;



Route::get('/',function(){

    return 'devlearn';

})->name('devlearn.dashboard');