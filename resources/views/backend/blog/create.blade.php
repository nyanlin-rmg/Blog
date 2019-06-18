@extends('layouts.backend.main')

@section('title', 'MyBlog | Add New Post')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Add New Post</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('backend.blog.index') }}">Blog</a>
                </li>
                <li class="active">Add New Post</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body ">
                            {!! Form::model($post, ['route' => 'backend.blog.store', 'method' => 'POST', 'files' => TRUE]) !!}
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    {!! Form::label('title') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    @if($errors->has('title'))
                                        <span class="help-block"><i>{{ $errors->first('title') }}</i></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                    {!! Form::label('slug') !!}
                                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('slug'))
                                        <span class="help-block"><i>{{ $errors->first('slug') }}</i></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                                    {!! Form::label('excerpt') !!}
                                    {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('excerpt'))
                                        <span class="help-block"><i>{{ $errors->first('excerpt') }}</i></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                    {!! Form::label('body') !!}
                                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('body'))
                                        <span class="help-block"><i>{{ $errors->first('body') }}</i></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                    {!! Form::label('body') !!}
                                    {!! Form::select('category_id', $categories->pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Choose Category']) !!}
                                    @if($errors->has('category_id'))
                                        <span class="help-block"><i>{{ $errors->first('category_id') }}</i></span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    {!! Form::file('image') !!}
                                    @if($errors->has('image'))
                                        <span class="help-block"><i>{{ $errors->first('image') }}</i></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Published') !!}
                                    {!! Form::checkbox('published', 1); !!}
                                </div>
                                <div>
                                    {{ Form::submit('Add New Post', ['class' => 'btn btn-primary']) }}
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="box-footer clearfix">
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