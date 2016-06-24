@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>

    <div class="row">
        <div class="col-sm-4"><img class="responsive" src="{{$post->photo->name}}" alt=""></div>
        <div class="col-sm-8">
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update',$post->id], 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id',$categories, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Text:') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::submit('Update', ['class'=>'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
            <div class="form-group col-sm-6">
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger  pull-right']) !!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>


    @include('includes.form_errors')
@endsection