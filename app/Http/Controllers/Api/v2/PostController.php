<?php

namespace App\Http\Controllers\Api\v2;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class PostController extends Controller
{
    public function posts(){

        $posts = Post::get();

        return response()->json($posts);
    }
}
