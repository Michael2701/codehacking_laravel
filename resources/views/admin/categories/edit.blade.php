@extends('layouts.admin')

@section('content')
    <h1>Edit Categories</h1>
    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif
<div class="row">
    {!! Form::model($category,['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}

    <div class="form-group">

        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}

    </div>

    <div class="form-group col-sm-6">
        {!! Form::submit('Update', ['class'=>'btn btn-info']) !!}
    </div>

    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

    <div class="form-group col-sm-6">
        {!! Form::submit('Delete', ['class'=>'btn btn-danger pull-right']) !!}
    </div>
    {!! Form::close() !!}

</div>
    @include('includes.form_errors')
@endsection