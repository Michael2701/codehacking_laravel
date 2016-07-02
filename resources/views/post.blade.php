@extends('layouts/blog-post')



@section('content')

<!-- Blog Post -->

<!-- Title -->
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo ? $post->photo->name : '/images/placeholder.png'}}" alt="">

<hr>

<!-- Post Content -->
<p>{{$post->body}}</p>

<hr>

<!-- Blog Comments -->
@if(Auth::check())
<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif
    {!! Form::open(['method'=>'POST', 'action'=>['PostCommentsController@store']]) !!}

    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div class="form-group">

        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        <br>
        <div class="form-group">
            {!! Form::submit('Submit comment', ['class'=>'btn btn-info']) !!}
        </div>

    </div>
    {!! Form::close() !!}
</div>
@endif
<hr>

<!-- Posted Comments -->

<!-- Comment -->

@if(count($comments) > 0)
    @foreach($comments as $comment)
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" height="64" src="{{ $comment->photo ? $comment->photo : '/images/user.png' }}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->author }}
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </h4>
                    <p>{{ $comment->body }}</p><hr>
                <button class="reply-button btn btn-default pull-right">Reply</button>
                <!-- Nested Comment -->




                    <div class="replies-container col-lg-8" id="{{$comment->id}}">
                    @if(count($comment->replies) > 0)
                        @foreach($comment->replies as $reply)
                            @if($reply->is_active == 1)
                            <br>

                            <div class="media" >
                                <a class="pull-left" href="#">
                                    <img class="media-object" height="64" src="{{ $reply->photo ? $reply->photo :'/images/user.png'}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $reply->author }}
                                        <small>{{ $reply->created_at->diffForHumans() }}</small>
                                    </h4>
                                    <p>{{ $reply->body }}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                    </div>



                    <!-- End Nested Comment -->
                    <div class="reply-container col-lg-12">
                        @if(session('message'))
                            <p class="alert-info">{{session('reply_message')}}</p>
                        @endif
                            <br>
                        {{--<h4>Reply:</h4>--}}
                        {!! Form::open(['method'=>'POST', 'action'=>['CommentRepliesController@createReply']]) !!}
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <div class="form-group">
                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows'=>'2']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class'=>'btn btn-info']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>



            </div>
        </div>
    @endforeach
@endif



@endsection