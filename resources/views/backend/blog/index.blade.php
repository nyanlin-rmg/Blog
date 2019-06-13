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
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
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
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $posts->links() }}
                            </div>
                            <div class="pull-right">
                                <small>{{ $posts->count() }} items</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection