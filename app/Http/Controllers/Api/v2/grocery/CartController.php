<?php

namespace App\Http\Controllers\Api\v2\grocery;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CartCollection;

class CartController extends Controller
{
   
    public function index()
    {
        
        $user = auth()->user();
        //$cart_items = new CartResource($user->cart_items);
        $cart_items = $user->cart_items;
        
        foreach($cart_items as $item){
            
            $product = Product::find($item->product_id);

            if($item->quantity > $product->quantity){
                $item->quantity = $product->quantity;
                $item->save();
            }
        } 
        
        return  CartResource::collection($cart_items);
    }

   
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {  
       
        $item = Cart::where('user_id',auth()->user()->id)->where('product_id',$request->productId)->first();

        if( $item){
            $item->quantity = $item->quantity + $request->quantity;
            $item->save();
        }else{
            $item = new Cart;
            $item->user_id =  auth()->user()->id;
            $item->product_id = $request->productId;
            $item->quantity = $request->quantity;
            $item->save();
        }

        return $item;

        $user = auth()->user()->id;
        return $request;
        return 'Add to cart from web controller';

        // $chat = New Chat;
        // $chat->name = $request->name;
        // $chat->save();
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request)
    {
        

        if($request->add){
            $cart = Cart::find($request->cartId);
            $cart->quantity = $cart->quantity +1;
            $cart->save(); 
            return 'Item will be added';
        }else{
            $cart = Cart::find($request->cartId);
            $cart->quantity = $cart->quantity -1;
            $cart->save(); 
            return 'item will be deleted';
        }
    }

    
    public function destroy(Request $request)
    {
        

        $cart = Cart::destroy($request->cartId);

        if($cart){
            return response()->json(['message' => 'Deleted successfully'],200);
        }else{
            return response()->json(['message' => 'Error'],500);
        }

    }

    public function delete_user_cart(){

        $user = auth()->user();
        $cart_items = $user->cart_items;
        foreach($cart_items as $item) {
            Cart::destroy($item->id);
        }
    }
}
