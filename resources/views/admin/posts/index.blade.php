@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Author</th>
            <th>Category</th>
            <th>Title</th>
            <th>Text</th>
            <th>View Post</th>
            <th>View Comments</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
    @if($posts)
        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td><img height="50" src="{{$post->photo ? $post->photo->name : '/images/placeholder.png'}}"></td>
            <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
            <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
            <td>{{$post->title}}</td>
            <td>{{str_limit($post->body, 30)}}</td>
            <td><a href="{{ route('home.post', $post->id) }}">View post</a></td>
            <td><a href="{{ route('admin.comments.show', $post->id) }}">View comments</a></td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>


@endsection


