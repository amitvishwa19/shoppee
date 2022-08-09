<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FCMController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SandboxController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ErrorLogController;
use App\Http\Controllers\Admin\FacebookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\ImpersonateController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Devcomm\ProductCategoryController;

    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::resource('/profile',ProfileController::class);
    
    

    //App Menu Controller Routes
    Route::resource('/menu',MenuController::class);
    Route::get('/menu/{menu}/builder',[MenuController::class,'builder'])->name('menu.builder');
    Route::post('/menu/{menu}/builder/order',[MenuController::class,'order_item'])->name('menu.builder.order.item');
    Route::get('/menu/{menu}/builder/create',[MenuController::class,'addMenuItem_create'])->name('menu.item.create');
    Route::post('/menu/{menu}/builder/create',[MenuController::class,'addMenuItem'])->name('menu.item.add');
    Route::get('/menu/{menu}/builder/{item}/edit',[MenuController::class,'editMenuItem'])->name('menu.item.edit');
    Route::put('/menu/{menu}/builder/{item}/edit',[MenuController::class,'updateMenuItem'])->name('menu.item.update');
    Route::delete('/menu/{menu}/builder/{item}/delete',[MenuController::class,'deleteMenuItem'])->name('menu.item.delete');


    //Post
    Route::resource('/post',PostController::class);

    //Access Control
    Route::resource('/user',UserController::class);
    Route::resource('/permission',PermissionController::class);
    Route::resource('/role',RoleController::class);

    //Error Logs
    Route::get('/logs',[ErrorLogController::class,'index'])->name('admin.logs');


    //Activity Log
    Route::resource('/activity',ActivityLogController::class);

    //Mail Templates
    Route::resource('/mtemplate',MailTemplateController::class);

    //crm
    //Route::resource('/posts',PostController::class);
    Route::resource('/category',CategoryController::class);
    Route::resource('/tag',TagController::class);
    Route::resource('/subscription',SubscriptionController::class);
    Route::resource('/inquiry',InquiryController::class);
    Route::resource('/chat',ChatController::class);
    Route::resource('/file',FileController::class);


    //Sandbox
    Route::get('/mail',[SandboxController::class,'mail'])->name('sandbox.mail');
    Route::get('/mail/simple',[SandboxController::class,'simpleMail'])->name('sandbox.mail.simple');
    Route::get('/mail/dispatch',[SandboxController::class,'dispatchMail'])->name('sandbox.mail.dispatch');
    Route::post('/mail/dispatch/custom',[SandboxController::class,'dispatchMailCustom'])->name('sandbox.mail.dispatch.custom');

    //Sandbox-Aws server
    Route::resource('/server',ServerController::class);

    //Imporsonate
    if ('production' != config('app.env')) {
        Route::get('/impersonate',[ImpersonateController::class,'index'])->name('impersonate.index');
        Route::get('/impersonate/enter/{user_id}',[ ImpersonateController::class, 'impersonate'])->name('impersonate.enter');
        Route::get('/impersonate/leave',[ ImpersonateController::class, 'impersonate_leave'])->name('impersonate.leave');
    }

     //Client
     Route::resource('/contact',ContactController::class);

    //Client
    Route::resource('/client',App\Http\Controllers\Admin\ClientController::class);

     //Projects
    Route::resource('/project',ProjectController::class);
    Route::post('/project/quotation',[ProjectController::class, 'project_quotation'])->name('project.quotation');
    Route::get('/project/billing/{id}',[ProjectController::class, 'project_billing'])->name('project.billing');
    Route::get('/project/quotation/pdf/{id}',[ProjectController::class, 'project_quotation_pdf'])->name('project.quotation.pdf');


    //Tasks
    Route::resource('/task',TaskController::class);
    //File
    Route::resource('/filemanager',FilemanagerController::class);
    //Note
    Route::resource('/note',NoteController::class);

    Route::get('/facebook/connect',[ProfileController::class,'facebookRedirect'])->name('facebook.connect');
    Route::get('/facebook/callback',[ProfileController::class,'facebookCallback'])->name('facebook.callback');
    Route::post('facebook/page/add',[FacebookController::class,'add_fb_page'])->name('facebook.page.id.add');

    Route::get('facebook/page/data',[FacebookController::class,'fb_data'])->name('facebook.data');
    Route::post('facebook/post/publish',[FacebookController::class,'publishToPage'])->name('facebook.publish');


    Route::resource('/setting',SettingController::class);


    Route::get('/fcm',[FCMController::class,'index'])->name('fcm');
    Route::post('/fcm/send',[FCMController::class,'send_message'])->name('fcm.send');






    //=============================Ecomm===========================================
    Route::resource('/product_category',ProductCategoryController::class);