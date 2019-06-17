<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BackendController;

class BlogController extends BackendController
{
    public function index()
    {
        $posts = Post::paginate(5);
        $postCount = Post::count();

        return view('backend.blog.index', compact('posts', 'postCount'));
    }

    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }
}
