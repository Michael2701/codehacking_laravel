@extends('layouts/admin')

@section('content')

    <h1>Upload Media</h1>

    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif

    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediasController@store','name'=>'name', 'class'=>'dropzone']) !!}
    {!! Form::close() !!}

@endsection