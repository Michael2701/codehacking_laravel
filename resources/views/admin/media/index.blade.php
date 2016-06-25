@extends('layouts/admin')

@section('content')
<h1>Media</h1>
@if(session('message'))
    <p class="alert-info">{{session('message')}}</p>
@endif
@if($photos)
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
        </tr>
    </thead>
    <tbody>
    @foreach($photos as $photo)
        <tr>
            <td>{{$photo->id}}</td>
            <td><img src="{{$photo->name}}" alt="" width="100" class="img-responsive"></td>
            <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
            <td>
                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id], 'file'=>true]) !!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif
@endsection