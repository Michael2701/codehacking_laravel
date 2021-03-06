@extends('layouts/admin')

@section('content')

    <h1>Users</h1>
    @if(session('message'))
    <p class="alert-info">{{session('message')}}</p>
    @endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
    @if($users)
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td><img height="50" src="{{$user->photo ? $user->photo->name : '/images/user.png'}}" alt=""></td>
            <td><a href="{{route('admin.users.edit', $user->id)}}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->name }}</td>
            <td>{{ $user->is_active == 1 ? 'Active' : "No Active" }}</td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>






@endsection



@section('footer')
@endsection