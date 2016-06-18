@extends('layouts/admin')

@section('content')
    <h1 class="text-center">Edit User</h1>
<div class="col-md-3">
    <img src="{{$user->photo ? $user->photo->name : '/images/user.png'}}" alt="" class="img-responsive">
</div>
<div class="col-md-9">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

    <div class="form-group">

        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}

    </div>


    <div class="form-group">

        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id',$roles, null, ['class' => 'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', array(1=>'Active',0=>'Not Active'),null, ['class' => 'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('photo_id', 'Image:') !!}
        {!! Form::file('photo_id', ['class' => 'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}

    </div>

    <div class="form-group col-sm-6">
        {!! Form::submit('Update User', ['class'=>'btn btn-info']) !!}
    </div>

    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
       <div class="form-group col-sm-6">
           {!! Form::submit('Delete User', ['class'=>'btn btn-danger  pull-right']) !!}
       </div>

    {!! Form::close() !!}


    @include('includes.form_errors')
</div>

@endsection



@section('footer')
@endsection