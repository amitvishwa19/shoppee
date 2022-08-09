<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\AutoDeployController;
use App\Http\Controllers\Admin\SubscriptionController;




Route::get('/', [ClientController::class, 'home'])->name('app.home');
//Route::get('/home', [ClientController::class, 'home'])->name('home');
Route::get('/contact', [ClientController::class, 'contact'])->name('app.contact');
Route::get('/about', [ClientController::class, 'about'])->name('app.about');
Route::get('/service', [ClientController::class, 'services'])->name('app.service');
Route::get('/blogs', [ClientController::class, 'blogs'])->name('app.blogs');
Route::get('/blog/{slug}', [ClientController::class, 'blog'])->name('app.blog');
Route::get('/blogs/category/{category}', [ClientController::class, 'blogs_category'])->name('app.blogs.category');
Route::get('/blogs/tag/{tagy}', [ClientController::class, 'blogs_tag'])->name('app.blogs.tag');
Route::get('/cookie_consent', [ClientController::class, 'cookie_consent'])->name('app.cookie.consent');
Route::get('/artisan-call', [ClientController::class, 'artisan_call']);



Route::get('/auth/verify',[RegisterController::class,'verifyUser'])->name('app.auth.verify');

Route::get('/upload',function(){

    //return Storage::url();
    return upload('sdfsdfsd');
    return 'upload';

});


//Devlomatix Solutions & Devlomatix Games policy
Route::get('/games/privacy', [PolicyController::class, 'DevlomatixGamesPrivacy'])->name('games.privacy');
Route::get('/games/terms', [PolicyController::class, 'DevlomatixGamesTerms'])->name('games.terms');


Route::get('/privacy', [PolicyController::class, 'DevlomatixSolutionsPrivacy'])->name('privacy');
Route::get('/terms', [PolicyController::class, 'DevlomatixSolutionsTerms'])->name('terms');

// App Subscription
Route::post('/subscribe',[ClientController::class,'subscribe'])->name('app.subscribe');

// App Inquiry
Route::post('/inquire', [ClientController::class, 'inquiry'])->name('app.inquire');

//Auto deploy of app
Route::post('/deploy',[AutoDeployController::class,'deploy'])->name('app.auto.deploy');
Route::post('/git/deploy',[AutoDeployController::class,'gitDeploy'])->name('app.git.deploy');
