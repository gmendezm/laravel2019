@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go Back</a>
    <div class="card p-3 m-3">
        <h1>{!!$post->title!!}</h1>
        <small>Written on {{ $post->created_at }} by <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></small>

        @if ($post->cover_image != '')
            <img style="width:100%" src="/storage/cover/images/{{$post->cover_image}}" alt="Cover Image">
        @endif

        <div>
            {{$post->body}}
        </div>
        <hr>

        @if (!Auth::guest() && auth()->user()->id == $post->user->id)
       {{-- @if (!Auth::guest() && Auth::user()->id == $post->user->id) --}}
            {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}

            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary m-3">Edit</a> 

            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}

            {!!Form::close()!!}
        @endif
    </div>
@endsection