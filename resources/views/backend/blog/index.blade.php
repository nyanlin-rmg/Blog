@extends('layouts.backend.main')

@section('title', 'MyBlog | Blog index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Display All Blog Posts</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('backend.blog.index') }}">Blog</a>
                </li>
                <li class="active">All Posts</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('backend.blog.create') }}" class="btn btn-success">Add New Post</a>
                        </div>
                        <div class="box-body ">
                            @if(session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if(!$posts->count())
                                <div class="alert alert-danger">
                                    No Post Found
                                </div>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Published</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->author->name }}</td>
                                                <td>{{ $post->category->title }}</td>
                                                <td>
                                                    @if($post->published == true)
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    @else
                                                        <i class="fa fa-minus"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <abbr title="{{ $post->dateFormatted() }}">{{ $post->dateFormatted() }}</abbr>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-default">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $posts->links() }}
                            </div>
                            <div class="pull-right">
                                <small>{{ $postCount }} items</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin')
    </script>
@endsection