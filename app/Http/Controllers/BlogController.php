<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::with(['posts' => function($query) {
                        $query->where('published', true);
                    }])
                    ->orderBy('title', 'asc')
                    ->get();
        
        $posts = Post::with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        
        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        $categories = Category::with(['posts' => function($query) {
                        $query->where('published', true);
                    }])
                    ->orderBy('title', 'asc')
                    ->get();

        if($post->published == false) {
            abort(404);
        }
        return view('blog.show', compact('post', 'categories'));
    }

    public function category($id)
    {
        $categories = Category::with(['posts' => function($query) {
                        $query->where('published', true);
                    }])
                    ->orderBy('title', 'asc')
                    ->get();

        $posts = Post::with('author')
            ->orderBy('created_at', 'desc')
            ->where('category_id', $id)
            ->paginate(5);

        return view('blog.index', compact('posts', 'categories'));
    }
}
