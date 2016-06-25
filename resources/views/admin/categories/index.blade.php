@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>
    @if(session('message'))
        <p class="alert-info">{{session('message')}}</p>
    @endif
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['method'=>'POST', 'action'=>['AdminCategoriesController@store']]) !!}


            <div class="form-group">

                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}

            </div>

            <div class="form-group">
                {!! Form::submit('Create', ['class'=>'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @if($categories)
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                            <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'no date'}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @include('includes.form_errors')
@endsection