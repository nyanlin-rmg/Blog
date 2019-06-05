<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class BlogController extends Controller
{
    public function index()
    {
        $categories = $this->getCategories(); 
        $posts = Post::with('author')
                        ->where('published', true)
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        $categories = $this->getCategories();

        if($post->published == false) {
            abort(404);
        }
        return view('blog.show', compact('post', 'categories'));
    }

    public function category(Category $category)
    {
        $categories = $this->getCategories();

        $posts = $category->posts()
                            ->with('author')
                            ->where('published', true)
                            ->paginate(5);

        return view('blog.index', compact('posts', 'categories', 'category'));
    }

    private function getCategories()
    {
        $categories = Category::with(['posts' => function($query) {
                                    $query->where('published', true);
                                }])
                                ->orderBy('title', 'asc')
                                ->get();
        
        return $categories;
    }
}
