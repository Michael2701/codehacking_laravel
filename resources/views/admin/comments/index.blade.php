@extends('layouts/admin')

@section('content')



    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif

    @if(count($comments) > 0)

    <h1>All comments</h1>
    @if(session('message'))
        {{session('message')}}
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>View Post</th>
                <th>View Replies</th>
            </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>
                    <img height="50" src="{{$comment->photo ? $comment->photo : '/images/user.png' }}" alt="{{ $comment->photo }}">
                    <br>{{ $comment->author }}
                </td>
                <td>{{ $comment->email}}</td>
                <td>{{ $comment->body }}</td>
                <td><a href="{{route('home.post', $comment->post->id)}}">{{$comment->post->title}}</a></td>
                <td><a href="{{route('admin.comments.replies.show', $comment->id)}}">View Replies</a></td>
                <td>
                    @if($comment->is_active == 1)
                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                        <input type="hidden" value="0" name="is_active">
                        <div class="form-group">
                            {!! Form::submit('Un-approve', ['class'=>'btn btn-warning']) !!}
                        </div>
                    {!! Form::close() !!}
                    @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                        <input type="hidden" value="1" name="is_active">
                        <div class="form-group">
                            {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    @endif
                </td>
                <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @else <h1>No comments</h1>
    @endif
@endsection