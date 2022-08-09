<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {   
        //dd(auth()->user()->role);
       
        if ($request->ajax()) {

            $products = Product::orderby('created_at','desc')->latest('id');
            //$products = auth()->user()->products;

            

            return Datatables::of($products)
            ->editColumn('created_at',function(Product $product){
                return $product->created_at->diffForHumans();
            })

            ->addColumn('image',function($products){
                return '<div class="d-flex justify-content-between">
                                <div class="meta-box">
                                <div class="media">
                                    <img src="'.$products->feature_image.'" height="40" class="mr-3 align-self-center rounded" alt="...">
                                    
                                </div>                                      
                                </div><!--end meta-box-->
                               
                            </div>';
            })
            ->addColumn('categories',function($products){
                $categories = $products->categories;
                //return $categories;
                $cat = '';

                if($categories){
                    foreach($categories as $category){
                       $cat = $cat. '<div class="badge badge-info mr-1" >'. $category->name .'</div>';
                    };
                }

                return $cat;
            })

            ->editColumn('quantity',function($product){
                if($product->quantity == 0){
                    return '<div class="badge badge-danger mr-1" >Out of Stock</div>';
                }else{
                    return $product->quantity;
                }
                
            })
            ->editColumn('status',function($product){
                if($product->status == true){
                    return '<div class="badge badge-soft-success mr-1" >Active</div>';
                }else{
                    return '<div class="badge badge-soft-danger mr-1" >InActive</div>';
                }
                
            })

            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('product.edit',$data->id).'" class="badge badge-soft-success mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-secondary delete mr-2"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['image','action','categories','quantity','status'])
            ->make(true);


        }


        return view('admin.pages.product.product');

    }

    public function create()
    {
        $products = Product::orderby('created_at','desc')->get();
        $cat = Category::where('slug','product-categories')->first();
        
        $categories = Category::with('childs')->where('parent_id',$cat->id)->where('status',true)->get();
        return view('admin.pages.product.product_add')->with('categories',$categories)->with('products',$products);
    }

    public function store(Request $request)
    {

       
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'sku' => 'required',
            'quantity' => 'required|numeric',
            'feature_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = New Product;
        $product->user_id = auth()->user()->id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title,'-');
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->sku = $request->sku;
        $product->quantity = $request->quantity;
        $product->rating = $request->rating;
        if($file = $request->file('feature_image')){ $product->feature_image = uploadImage($request->file('feature_image'));}

        if($request->featured){
            $product->featured = $request->featured;
        }else{$product->featured = 0;};

        if($request->status){
            $product->status = $request->status;
        }else{$product->status = 0;};

        $product->related = $request->related;
        $product->save();

        //Categoty Saving
        if(!$request->categories){
            $product->categories()->sync([$this->defaultCategory()]);
        }else{
            $product->categories()->sync($request->categories);
        }


        return redirect()->route('product.index')
        ->with([
            'message'    =>'Product Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    public function edit($id)
    {
        $products = Product::where('id','<>' ,$id)->orderby('created_at','desc')->get();
        $cat = Category::where('slug','product-categories')->first();
        
        $categories = Category::with('childs')->where('parent_id',$cat->id)->where('status',true)->get();
        $product = Product::findOrFail($id);

        //return response()->json($product);

        return view('admin.pages.product.product_edit')->with('product',$product)->with('categories',$categories)->with('products',$products);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'sku' => 'required',
            'quantity' => 'required|numeric',
            
        ]);

        $product = Product::findOrFail($id);
        $product->user_id = auth()->user()->id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title,'-');
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->sku = $request->sku;
        $product->quantity = $request->quantity;
        $product->rating = $request->rating;
        if($file = $request->file('feature_image')){ $product->feature_image = uploadImage($request->file('feature_image'));}

        if($request->featured){
            $product->featured = $request->featured;
        }else{$product->featured = 0;};

        if($request->status){
            $product->status = $request->status;
        }else{$product->status = 0;};

        $product->related = $request->related;
        $product->save();

        //Categoty Saving
        if(!$request->categories){
            $product->categories()->sync([$this->defaultCategory()]);
        }else{
            $product->categories()->sync($request->categories);
        }

        return redirect()->route('product.index')
        ->with([
            'message'    =>'Product Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $product = Product::destroy($id);

        if($product){
            return redirect()->route('product.index')
            ->with([
                'message'    =>'Product Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }

    public function defaultCategory()
    {
        $category = Category::where('slug','uncategorized')->first();
        if(!$category){
            $category = new Category;
            $category->name = 'Uncategorized';
            $category->slug = 'uncategorized';
            $category->save();

        }
        return $category->id;
    }

}
