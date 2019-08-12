<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;

class PostController extends Controller
{
    //
    public function show($slug)
    {
        //
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.post', ['post' => $post]);
    }
}
