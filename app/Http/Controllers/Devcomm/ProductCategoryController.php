<?php

namespace App\Http\Controllers\Devcomm;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::where('slug','product-categories')->first();
        $categories = Category::with('childs')->where('parent_id',$cat->id)->get();
        //return $categories;
        return view('admin.pages.product_category.category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validate = $request->validate([
            'category' => 'required'
        ]);

        $cat = Category::where('slug','product-categories')->first();


        $category = new Category;
        $category->name = $request->category;
        $category->slug = str_slug($request->category);
        if($request->parent == null){
            $category->parent_id = $cat->id;
        }else{
            $category->parent_id = $request->parent;
        }
        $category->class = $request->class;
        if($request->favourite){$category->favourite = true;}else{$category->favourite = false;}
        if($request->status){$category->status = true;}else{$category->status = false;}
        if($file = $request->file('feature_image')){ $category->feature_image = uploadImage($request->file('feature_image'));}
        $category->save();
        Cache::forget('categories');

        return redirect() ->route('product_category.index')
        ->with([
            'message'    =>'Category Created Successfully',
            'alert-type' => 'success',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::where('slug','product-categories')->first();

        $categories = Category::with('childs')->where('parent_id',$cat->id)->get();
        $category = Category::findOrFail($id);

        //return response()->json($category);

        return view('admin.pages.product_category.category_edit')->with('category',$category)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $cat = Category::where('slug','product-categories')->first();

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);

        if($request->parent == null){
            $category->parent_id = $cat->id;
        }else{
            $category->parent_id = $request->parent;
        }
        
        $category->class = $request->class;
        if($request->favourite){$category->favourite = true;}else{$category->favourite = false;}
        if($request->status){$category->status = true;}else{$category->status = false;}
        if($file = $request->file('feature_image')){ $category->feature_image = uploadImage($request->file('feature_image'));}
        $category->save();

        return redirect()->route('product_category.index')
        ->with([
            'message'    =>'Category Updated Successfully',
            'alert-type' => 'success',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::destroy($id);

        if($category){
            return redirect()->route('product_category.index')
            ->with([
                'message'    =>'Category Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }
    }
}
