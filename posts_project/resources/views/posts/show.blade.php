@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go Back</a>
    <div class="card p-3 m-3">
        <h1>{{$post->title}}</h1>
        <small>Written on {{ $post->created_at }}</small>
        <div>
            {{$post->body}}
        </div>
        <hr>    
    </div>
@endsection