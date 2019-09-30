@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go Back</a>
    <div class="card p-3 m-3">
        <h1>{!!$post->title!!}</h1>
        <small>Written on {{ $post->created_at }} by <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></small>
        <div>
            {{$post->body}}
        </div>
        <hr>

        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}

        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary m-3">Edit</a> 

        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}

        {!!Form::close()!!}
    </div>
@endsection