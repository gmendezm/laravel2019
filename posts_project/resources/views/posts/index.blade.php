@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @if(request('all')  )
        {{$posts->links()}}
        @endif
       
        @foreach($posts as $post)
            <div class="card p-3 m-3">
            <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
            <small>Written on {{ $post->created_at }} by <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></small>
            </div>
        @endforeach
        @if(request('all'))
            {{$posts->links()}}
        @endif
    @else
        <p>No posts found.</p>
    @endif
@endsection