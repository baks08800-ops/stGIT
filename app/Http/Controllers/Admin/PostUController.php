<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class PostUController extends Controller
{
        public function index()
    {
        $posts = Post::with('category')->orderBy('id','desc')->paginate(2);
        return view('postsU.index', compact('posts'));
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->views +=1;
        $post->update();
        return view('posts.show', compact('post'));
    }

}
