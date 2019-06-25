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
                                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) !!}
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
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                            <img data-src="holder.js/100%x100%"  alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div class="mt-3">
                                            <span class="btn btn-primary btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Published') !!}
                                    {!! Form::checkbox('published', 1); !!}
                                </div>
                                <div class="form-group">
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
        $('#title').on('blur', function () {
           var postTitle = this.value.toLowerCase().trim(),
               slugInput = $('#slug'),
               slug = postTitle.replace(/[^a-z0-9-]+/g, '-');

            slugInput.val(slug);
        });
    </script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('excerpt', options);
        CKEDITOR.replace('body', options);
    </script>
@endsection