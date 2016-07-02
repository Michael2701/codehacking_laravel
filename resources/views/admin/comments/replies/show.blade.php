@extends('layouts/admin')

@section('content')



    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif

    @if(count($replies) > 0)

        <h1>Replies on Comment Post : "{{$replies[0]->comment->post->title}}" </h1>
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
                <th>Created at</th>
                <th>Updated at</th>
                <th>View comment</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{ $reply->id }}</td>
                    <td>
                        <img height="50" src="{{$reply->photo ? $reply->photo : '/images/user.png' }}" alt="{{ $reply->photo }}">
                        <br>{{ $reply->author }}
                    </td>
                    <td>{{ $reply->email}}</td>
                    <td>{{ $reply->body }}</td>
                    <td>{{ $reply->created_at->diffForHumans() }}</td>
                    <td>{{ $reply->updated_at->diffForHumans() }}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View comment</a></td>
                    <td>
                        @if($reply->is_active == 1)
                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" value="0" name="is_active">
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-warning']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" value="1" name="is_active">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else <h1 class="text-center">No replies</h1>
    @endif
@endsection