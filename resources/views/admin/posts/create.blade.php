@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>


{!! Form::open(['method'=>'POST', 'action'=>['AdminPostsController@store'], 'files'=>true]) !!}
    <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id',[''=>'Choose Options'] + $categories, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('photo_id', 'Photo:') !!}
        {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Text:') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class'=>'btn btn-info']) !!}
    </div>
{!! Form::close() !!}
    @include('includes.form_errors')
@endsection