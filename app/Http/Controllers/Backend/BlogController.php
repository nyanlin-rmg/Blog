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

        return view('backend.blog.index', compact('posts'));
    }

    public function create()
    {
        dd("Create Route Works");
    }
}
