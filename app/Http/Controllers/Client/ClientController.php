<?php

namespace App\Http\Controllers\Client;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Inquiry;
use App\Models\Category;
use App\Events\InquiryEvent;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Events\SubscriptionEvent;
use App\Services\AppMailingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    public function home(Request $request)
    {
        
        //$value = $request->cookie('subscription');
        //dd(request()->cookie() );
        return view('client.pages.home');
    }

    public function blogs()
    {
       
        $posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->where('status','published')->get();

        $random_posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->where('status','published')->limit(5)->get();

        $categories = [];
        $blog_category = Category::where('slug','blog-categories')->first();
        if($blog_category){
            $categories = Category::where('parent_id', $blog_category->id )->orderby('created_at','desc')->get();
        }
        
        $tags = Tag::get();


        return view('client.pages.blogs')
                        ->with('posts',$posts)
                        ->with('random_posts',$random_posts)
                        ->with('categories',$categories)
                        ->with('tags',$tags);
    }

    public function blog($slug)
    {
        //dd('blogs');
        $post = Post::where('slug',$slug)->first();

        $random_posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->where('status','published')->limit(5)->get();

        $categories = [];
        $blog_category = Category::where('slug','blog-categories')->first();

        //dd($blog_category);

        if($blog_category){
            $categories = Category::where('parent_id', $blog_category->id )->orderby('created_at','desc')->get();
        }
        

        $tags = Tag::get();

        return view('client.pages.blog')
                            ->with('post',$post)
                            ->with('random_posts',$random_posts)
                            ->with('categories',$categories)
                            ->with('tags',$tags);
    }

    public function blogs_category($slug){
        $posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->get();

        $random_posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->where('status','published')->limit(5)->get();

        $blog_category = Category::where('slug','blog-categories')->first();
        $categories = Category::where('parent_id', $blog_category->id )->orderby('created_at','desc')->get();

        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->get();

        

        ///dd($posts);

        $tags = Tag::get();


        return view('client.pages.blogs')
                        ->with('posts',$posts)
                        ->with('random_posts',$random_posts)
                        ->with('categories',$categories)
                        ->with('tags',$tags);

    }

    public function blogs_tag($slug){
        $posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->get();

        $random_posts = Post::whereHas('categories', function($q)
        {
            $q->where('slug', '=', 'blog');
        })->where('status','published')->limit(5)->get();

        $blog_category = Category::where('slug','blog-categories')->first();
        $categories = Category::where('parent_id', $blog_category->id )->orderby('created_at','desc')->get();

        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->get();

        

        ///dd($posts);

        $tags = Tag::get();


        return view('client.pages.blogs')
                        ->with('posts',$posts)
                        ->with('random_posts',$random_posts)
                        ->with('categories',$categories)
                        ->with('tags',$tags);
            
    }

    public function about()
    {

        return view('client.pages.about');
    }

    public function services()
    {

        return view('client.pages.about');
    }


    public function contact()
    {

        return view('client.pages.contact');
    }

    public function subscribe(Request $request)
    {
        $subscription = New Subscription;
        $subscription->email = $request->email;
        $subscription->save();

        //$response = new Response('Hello world');
        //$response->withCookie(cookie('subscription','subscription',10));

        //event(new SubscriptionEvent($request));
        event(new SubscriptionEvent($request->email));
        //activity()->log('Look mum, I logged something');

        return redirect() ->route('app.home')->withCookie(cookie('subscription','subscription',10));

    }

    public function unSubscribe(Request $request,AppMailingService $mail){


    }

    public function inquiry(Request $request)
    {

        $validate = $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $inquiry = new Inquiry;
        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->phone = $request->phone;
        $inquiry->subject = $request->subject;
        $inquiry->message = $request->message;
        $inquiry->save();

        event(new InquiryEvent($request));
        return redirect() ->route('app.home');
    }

    public function cookie_consent()
    {
        return redirect()->back()->withCookie(cookie('cookie_consent','cookie_consent',(365 * 24 * 60)));
    }

    public function test(){
        // $settings = \AppSetting::all();
        // $settings = \AppSetting::set('app_name','devlomatix10');
        // $settings = \AppSetting::get('app_description');
        // return $settings;
        //return AppSetting::all();
        //return 'test from clientcontroller';

    }

    public function artisan_call(){

        // $input = [
        //     'model' => 'Test',
        //     'type'  => $data['commandType'],
        // ];
        Artisan::call('crud:generate', ['name' => 'Test']);
    }

    public function privacy_policy(){
        return view('client.pages.privacy');
    }
}
