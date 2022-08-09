<?php

namespace App\Http\Controllers\Api\v2\grocery;


use Carbon\Carbon;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use App\Http\Resources\CartCollection;
use App\Http\Resources\AddressResource;

class CheckoutController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders;
        return OrderResource::collection($orders);

        // $orders = Order::with('order_status')->get();
        // return $orders;
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {  
        

        $deliveryHours = 24;

        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->cart = serialize($request->cart);
        $order->address = serialize($request->address);
        $order->status =$request->status;
        $order->deliveryDate =Carbon::now()->addHours($deliveryHours);
        $order->payment_id =$request->payment_id;
        $order->save();

        //update product quantity items as per orde
        $cart_items = $request->cart;
        foreach($cart_items as $item){
            $product = Product::find($item['product']['id']);
            $product->quantity = $product->quantity - $item['quantity']; 
            $product->save();
            // if($item->quantity > $product->quantity){
            //     $item->quantity = $product->quantity;
            //     $item->save();
            // }
        } 

        if($order){

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $order->id;
            $orderStatus->title = 'Order Placed';
            $orderStatus->description = 'Order Placed successfully';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = true;
            $orderStatus->save();

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $order->id;
            $orderStatus->title = 'Getting Ready';
            $orderStatus->description = 'Order is ready and  waiting for despatch';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = false;
            $orderStatus->save();

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $order->id;
            $orderStatus->title = 'Despatched';
            $orderStatus->description = 'Order is out for delivery';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = false;
            $orderStatus->save();

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $order->id;
            $orderStatus->title = 'Deliverd';
            $orderStatus->description = 'Order Delivered successfully';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = false;
            $orderStatus->save();

            $user = auth()->user();
            $cart_items = $user->cart_items;
            foreach($cart_items as $item) {
                Cart::destroy($item->id);
            }

            return response()->json(['message' => 'success'],200);
        }
       
      
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update($id,Request $request)
    {
        
      
    }

   
    public function destroy(Request $request)
    {
        


    }

    public function cancelOrder(Request $request){
        $order = Order::find($request->id);
        $order->status = 'cancelled';
        $order->save();
        if($order){
            return response()->json(['message' => 'success'],200);
        }
    }

    public function cloneOrder(Request $request){
        $order = Order::find($request->id);
        $new_order = $order->replicate();
        $new_order->status = 'ordered';
        $new_order->save();

        if($new_order){
            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $new_order->id;
            $orderStatus->title = 'Order Placed';
            $orderStatus->description = 'Order Placed successfully';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = true;
            $orderStatus->save();

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $new_order->id;
            $orderStatus->title = 'Getting Ready';
            $orderStatus->description = 'Order is ready and  waiting for despatch';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = false;
            $orderStatus->save();

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $new_order->id;
            $orderStatus->title = 'Despatched';
            $orderStatus->description = 'Order is out for delivery';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = false;
            $orderStatus->save();

            $orderStatus = new OrderStatus;
            $orderStatus->order_id = $new_order->id;
            $orderStatus->title = 'Deliverd';
            $orderStatus->description = 'Order Delivered successfully';
            $orderStatus->time = Carbon::now();
            $orderStatus->status = false;
            $orderStatus->save();
            return response()->json(['message' => 'success'],200);
        }
    }
}
