<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\BackendController;
use Intervention\Image\Facades\Image;
use PhpOption\Tests\EnsureTest;
use PhpOption\Tests\PhpOptionRepo;

class BlogController extends BackendController
{
    protected $limit = 5;
    private $file_path;

    public function __construct()
    {
        parent::__construct();
        $this->file_path = public_path(config('img-setting.image.directory'));
    }

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

        $data = $this->handleRequest($request);

        $post = Post::create($data);

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
            'title'         => 'required',
            'slug'          => 'required|unique:posts',
            'excerpt'       => 'required',
            'body'          => 'required',
            'category_id'   => 'required',
            'image'         => 'mimes:jpg,jpeg,bmp,svg,png'
        ];
        $this->validate($request, $rules);
    }

    private function handleRequest(Request $request)
    {
        $data = [
            'author_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body,
            'excerpt' => $request->excerpt,
            'category_id' => $request->category_id,
            'view_count' => 100
        ];

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();

            $success = $image->move($this->file_path, $fileName);

            if($success) {
                $width = config('img-setting.image.thumbnail.width');
                $height = config('img-setting.image.thumbnail.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                Image::make($this->file_path . '/' . $fileName)
                        ->resize($width, $height)
                        ->save($this->file_path . '/' . $thumbnail);
            }

            $data['image'] = $fileName;
        }
        return $data;
    }
}
