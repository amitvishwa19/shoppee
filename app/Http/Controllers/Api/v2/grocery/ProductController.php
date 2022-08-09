<?php

namespace App\Http\Controllers\Api\v2\grocery;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ViewedProduct;
use App\Models\FavouriteProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ViewedResource;
use App\Http\Resources\WishlistResource;
use App\Http\Resources\GroceryProductResource;
use App\Http\Resources\Grocery\ProductResource;
use App\Models\Wishlist;

class ProductController extends Controller
{

    public function allProducts(){

        // $products = Post::whereHas('categories', function($q)
        // {
        //     $q->where('slug', '=', 'grocery-products');
        // })->where('status','published')->get();
        //return  GroceryProductResource::collection($products);

        // $products = Product::whereHas('categories', function($q)
        // {
        //     $q->where('slug', '=', 'grocery-products');
        // })->where('status',true)->orderBy('id','desc')->get();

        $products = Product::where('status',true)->get();

        //return $products;

        return  ProductResource::collection($products);

        

    }

    
    public function products($category)
    {
        
        $products = Product::whereHas('categories', function($q) use($category)
        {
            $q->where('slug', '=', $category);
        })->where('status',true)->get();

        return  ProductResource::collection($products);

    }


    public function viewed(Request $request){

        $vp = ViewedProduct::where('user_id',auth()->user()->id)->where('product_id',$request->productId)->first();

        if($vp){
            $vp->views = $vp->views + 1;
            $vp->save();
        }else{
            $vp =new  ViewedProduct();
            $vp->user_id = auth()->user()->id;
            $vp->product_id = $request->productId;
            $vp->save();
        }
        

        return $request->all();
        return 'viewed products';
    }

    public function recently_viewed(){
        
        $products = auth()->user()->viewedItems;
        return ViewedResource::collection($products);
       
    }


    public function most_viewed(){
        //$products = ViewedProduct::where('user_id','<>',auth()->user()->id)->orderBy('views', 'DESC')->get();
        $products = ViewedProduct::select('product_id')->groupBy('product_id')->orderBy('views','desc')->get();

        // $products = DB::table('viewed_products')
        //          ->select('post_id', DB::raw('views(*) as total'))
        //          ->groupBy('post_id')
        //          ->get();
        //return $products;

        return ViewedResource::collection($products);
        //return $products;
    }

    public function add_to_wishlist(Request $request){

        $wishlist = Wishlist::where('user_id',auth()->user()->id)->where('product_id',$request->productId)->first();

        if(!$wishlist){
            $item =new  Wishlist();
            $item->user_id = auth()->user()->id;
            $item->product_id = $request->productId;
            $item->save();

            return 'test';
        }
    }

    public function remove_from_wishlist(Request $request){

       
        $wishlist = Wishlist::where('product_id',$request->productId)->delete();

        if($wishlist ==1){
            return 'success';
        }else{
            return 'error';
        }
    }
    public function get_wishlist(){

        $wishlist = auth()->user()->wishlist;
        return WishlistResource::collection($wishlist);
    }

    public function search_items(Request $request){
        //return $request->string;
        $products = Product::where('title','like','%'.$request->string.'%')->get();
        return  ProductResource::collection($products);
    }
}
