<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;



class PostController extends Controller
{

    public function __construct(){



    }

    public function index(Request $request)
    {
        //dd(auth()->user()->posts()->with('author','categories')->latest('id'));
        if ($request->ajax()) {
            $posts = Post::orderby('created_at','desc')->latest('id');

            return Datatables::of($posts)
            ->editColumn('created_at',function(Post $post){
                return $post->created_at->diffForHumans();
            })
            ->addColumn('postdetails',function($post){
                return '<div class="media">
                            <img src="'.$post->feature_image.'" height="30" class="me-3 align-self-center rounded mr-2" alt="...">
                            <div class="media-body align-self-center">
                                <h6 class="m-0">'. $post->title.'</h6>
                                <small>'.$post->author->firstName .','. $post->author->lastName.'</small
                            </div><!--end media body-->
                        </div>';
            })

            ->addColumn('postmeta',function($post){
                if($post->feature_image){
                    return '<div class="d-flex justify-content-between">
                                <div class="meta-box">
                                <div class="media">
                                    <img src="'.$post->feature_image.'" height="40" class="mr-3 align-self-center rounded" alt="...">
                                    <div class="media-body align-self-center text-truncate">
                                        <h6 class="m-0 text-dark"><a href="'.route('post.edit',$post->id).'">'. $post->title.'</a></h6>
                                        <ul class="p-0 list-inline mb-0">
                                            <li class="list-inline-item text-muted">'.$post->created_at->diffForHumans().'</li>
                                            <li class="list-inline-item">by <a href="#" class="text-muted">'.$post->author->firstName .','. $post->author->lastName.'</a></li>
                                        </ul>
                                    </div><!--end media-body-->
                                </div>                                      
                                </div><!--end meta-box-->
                                <div class="align-self-center">
                                    <div class="badge badge-soft-info"> '.ucfirst($post->status).' </a></div>
                                </div>
                            </div>';
                }else{
                    return '<div class="d-flex justify-content-between">
                                <div class="meta-box">
                                    <div class="media">                                                                           
                                        <div class="media-body align-self-center text-truncate">
                                            <h6 class="m-0 text-dark"><a href="'.route('post.edit',$post->id).'">'. $post->title.'</h6>
                                            <ul class="p-0 list-inline mb-0">
                                                <li class="list-inline-item text-muted">'.$post->created_at->diffForHumans().'</li>
                                                <li class="list-inline-item">by <a href="#" class="text-muted">'.$post->author->firstName .','. $post->author->lastName.'</a></li>
                                            </ul>
                                        </div><!--end media-body-->
                                    </div>                                            
                                </div><!--end meta-box-->
                                <div class="align-self-center">
                                    <div class="badge badge-soft-info"> '.ucfirst($post->status).' </div>
                                </div>
                            </div>';
                }
            })


            ->addColumn('author',function($post){
                return $post->author->firstName .','. $post->author->lastName;
            })
            ->addColumn('category',function($post){
                $categories = $post->categories;
                //return $categories;
                $cat = '';

                if($categories){
                    foreach($categories as $category){
                       $cat = $cat. '<div class="badge badge-info mr-1" >'. $category->name .'</div>';
                    };
                }

                return $cat;
            })
            ->addColumn('tag',function($post){
                $tags = $post->tags;
                //return $categories;
                $tag = '';

                if($tags){
                    foreach($tags as $tg){
                       $tag = $tag. '<div class="badge badge-warning mr-1" >'. $tg->name .'</div>';
                    };
                }

                return $tag;
            })
            ->addColumn('status',function(Post $post){
                if($post->status == 'published'){
                    return '<a href="'.route('post.edit',$post->id).'" class="badge badge-soft-success"><small>Published</small></a>';
                }else{
                    return '<a href="'.route('post.edit',$post->id).'" class="badge badge-soft-danger"><small>Draft</small></a>';
                }
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('post.edit',$data->id).'" class="badge badge-soft-success mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-secondary delete mr-2"><small>Delete</small></a>'.
                            '<div class="dropdown kanban-main-dropdown show">
                                <a class="dropdown-toggle  badge badge-info" id="drop1" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="true">
                                    <i class="fab fa-facebook-f"></i>
                                    <span class="submitspinner'.$data->id.'"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="drop1" x-placement="bottom-end" style="position: absolute; transform: translate3d(-136px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a href="javascript:void(0);" class="dropdown-item fbpublish" data-pid="'.$data->id.'" data-type="text">Text Post</a>
                                    <a href="javascript:void(0);" class="dropdown-item fbpublish" data-pid="'.$data->id.'" data-type="image">Image Post</a>
                                    <a href="javascript:void(0);" class="dropdown-item fbpublish" data-pid="'.$data->id.'" data-type="link">Link Post</a>
                                </div>
                            </div>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','status','author','category','postdetails','postmeta','tag'])
            ->make(true);


        }

        $posts = Post::orderby('created_at','desc')->get();
        return view('admin.pages.posts.post')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderby('created_at','desc')->get();
        //dd($categories);
        return view('admin.pages.posts.post_add')->with('categories',$categories);
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
            'title' => 'required',
        ]);


        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title,'-');
        $post->description = $request->description;
        $post->body = $request->body;
        $post->status = $request->status;
        if($file = $request->file('feature_image')){ $post->feature_image = uploadImage($request->file('feature_image'));}
        $post->save();


        //Categoty Saving
        if(!$request->categories){
            $post->categories()->sync([$this->defaultCategory()]);
        }else{
            $post->categories()->sync($request->categories);
        }

        

        //Saving Tags
        $tagIds = [];
        if($request->tags){

            $tags = $request->tags;
            foreach($tags as $tag){

                $ntag = Tag::firstOrCreate(['name'=>ucFirst($tag),'slug'=>str_slug( $tag)]);
                if($tag)
                {
                    $tagIds[] = $ntag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }



        return redirect() ->route('post.index')
        ->with([
            'message'    =>'Post Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderby('created_at','desc')->get();
        //$tags = Tag::orderby('created_at','desc')->get();
        return view('admin.pages.posts.post_edit')->with('post',$post)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //dd($post);
        //dd($request->all());
        $validate = $request->validate([
            'title' => 'required',
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title,'-');
        $post->description = $request->description;
        $post->status = $request->status;
        $post->body = $request->body;
        if($file = $request->file('feature_image')){ 
            $post->feature_image = uploadImage($request->file('feature_image'));
        }else{
            if(!$request->feature_image_url){
                $post->feature_image = null;
            }   
        }
        $post->update();

        //Categoty Saving
        if(!$request->categories){
            $post->categories()->sync([$this->defaultCategory()]);
         }else{
            $post->categories()->sync($request->categories);
         }

        //Saving Tags
        $tagIds = [];
        if($request->tags){

            $tags = $request->tags;
            foreach($tags as $tag){

                $ntag = Tag::firstOrCreate(['name'=>ucFirst($tag),'slug'=>str_slug( $tag)]);
                if($tag)
                {
                    $tagIds[] = $ntag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }
        


        return redirect() ->route('post.index')
        ->with([
            'message'    =>'Post Updated Successfully',
            'alert-type' => 'success',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::destroy($id);
        if($post){
            return redirect()->route('post.index')
            ->with([
                'message'    =>'Post Deleted Successfully',
                'alert-type' => 'success',
            ]);
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
