<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->orderBy('created_at', 'desc')->paginate(5);
        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if($post->published == false) {
            abort(404);
        }
        return view('blog.show', compact('post'));
    }
}
