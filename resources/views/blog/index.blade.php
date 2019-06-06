@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
        @if(!($posts->count()))
            <div class="alert alert-info">
                Nothing To Show On This Category
            </div>
        @else
            @if(isset($category))
                <div class="alert alert-info">Category->{{ $category->title }}</div>
            @endif
            @if(isset($author))
                <div class="alert">Author->{{ $author->name }}</div>
            @endif
            @foreach ($posts as $post)
                <article class="post-item">
                @if($post->image_url)
                        <div class="post-item-image">
                            <a href="post.html">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                            </a>
                        </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                            <p>{!! $post->excerpt_html !!}</p>
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{ route('author', $post->author->slug) }}"> {{ $post->author->name }}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time>{{ $post->created_date }}</time></li>
                                    <li><i class="fa fa-tags"></i><a href="{{ route('category', $post->category) }}"> {{ $post->category->title }}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="post.html">Continue Reading &raquo;</a>
                            </div>
                        </div>
                    </div>
                </article>                
            @endforeach
        @endif

            <nav>
                <ul class="pager">
                    {{ $posts->links() }}
                </ul>
            </nav>
        </div>
        @include('layouts.sidebar')
    </div>
</div>
@endsection