@extends('layouts/admin')

@section('content')

    <h1>Comments</h1>

    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif



@endsection