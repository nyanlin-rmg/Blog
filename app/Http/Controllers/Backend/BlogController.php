<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BackendController;
use PhpOption\Tests\EnsureTest;
use PhpOption\Tests\PhpOptionRepo;

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
        $categories = Category::all();
        return view('backend.blog.create', compact('post', 'categories'));
    }

    public function store(Request $request)
    {
        $this->make_validation($request);

        $post = Post::create([
            'author_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body,
            'excerpt' => $request->excerpt,
            'category_id' => $request->category_id,
            'view_count' => 100
        ]);

        if($request->published) {
            $post->published = true;
        } else {
            $post->published = false;
        }

        $post->save();

        return redirect()->route('backend.blog.index')->with('message', 'Post was added successfully');
    }

    private function make_validation(Request $request)
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ];
        $this->validate($request, $rules);
    }
}
