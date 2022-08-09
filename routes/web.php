<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/mail', function(){

    $to = 'amitvishwa19@gmail.com';
    $subject = 'Test Mail Subject with job mail';
    $body = 'test body';
    $data = 'test data';
    $view = 'mails.subscription';

    return appmail($to,$subject,$body,$data,$view,true);

});

Route::prefix('/')->group(base_path('routes/client.php'));

Route::middleware('auth')->prefix('admin')->group(base_path('routes/admin.php'));

Route::middleware('auth')->prefix('devlearn')->group(base_path('routes/devlearn.php'));

Route::middleware('auth')->group(base_path('routes/devcomm.php'));


Auth::routes();

// Route::group(['middleware'=>['auth'],'prefix'=>'admin'],function(){

    

// });


