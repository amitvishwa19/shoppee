<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v2\AuthController;
use App\Http\Controllers\Api\v2\PostController;

use App\Http\Controllers\Api\v2\grocery\CartController;
use App\Http\Controllers\Api\v2\grocery\SliderController;
use App\Http\Controllers\Api\v2\grocery\AddressController;
use App\Http\Controllers\Api\v2\grocery\ProductController;
use App\Http\Controllers\Api\v2\grocery\CategoryController;
use App\Http\Controllers\Api\v2\grocery\CheckoutController;
use App\Http\Controllers\Api\v2\grocery\WishlistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v2')->group(function(){

    Route::post('login',[AuthController::class,'login']);
    Route::post('login/firebase',[AuthController::class,'firebaseLogin']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('fcmid/add',[AuthController::class,'add_fcm_id']);
    
    

    Route::middleware('auth:api')->group(function(){
        Route::get('refresh',[AuthController::class,'refresh']);
        Route::get('user',[AuthController::class,'user']);
        Route::get('posts',[PostController::class,'posts']);

        Route::post('products/viewed',[ProductController::class,'viewed']);
        Route::get('products/viewed/recent',[ProductController::class,'recently_viewed']);
        Route::get('products/viewed/most',[ProductController::class,'most_viewed']);

        Route::post('wishlist/add',[ProductController::class,'add_to_wishlist']);
        Route::post('wishlist/remove',[WishlistController::class,'destroy']);
        Route::get('wishlist/get',[WishlistController::class,'index']);

        Route::get('cart',[CartController::class,'index']);
        Route::post('cart/add',[CartController::class,'store']);
        Route::post('cart/delete',[CartController::class,'destroy']);
        Route::post('cart/update',[CartController::class,'update']);
        Route::post('cart/delete/all',[CartController::class,'delete_user_cart']);

        Route::get('checkout/address',[AddressController::class,'index']);
        Route::post('checkout/address/add',[AddressController::class,'store']);
        Route::post('checkout/address/delete',[AddressController::class,'destroy']);

        Route::get('checkout/orders',[CheckoutController::class,'index']);
        Route::post('checkout/order/add',[CheckoutController::class,'store']);
        Route::post('checkout/order/cancel',[CheckoutController::class,'cancelOrder']);
        Route::post('checkout/order/clone',[CheckoutController::class,'cloneOrder']);



    });


    Route::get('categories',[CategoryController::class,'index']);
    Route::get('slider',[SliderController::class,'index']);

    Route::get('products',[ProductController::class,'allProducts']);
    Route::get('products/{cat}',[ProductController::class,'products']);
    Route::post('products/search',[ProductController::class,'search_items']);

    // Route::prefix('grocery')->group(function(){

        
    //     Route::get('categories',[CategoryController::class,'index']);
    //     Route::get('slider',[SliderController::class,'index']);

    //     Route::get('products',[ProductController::class,'allProducts']);
    //     Route::get('products/{cat}',[ProductController::class,'products']);
    //     Route::post('products/search',[ProductController::class,'search_items']);
        
        

    // });
   


});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
