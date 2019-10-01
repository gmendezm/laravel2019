@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @if(request('all')  )
        {{$posts->links()}}
        @endif
       
        @foreach($posts as $post)
            <div class="card p-3 m-3">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        @if ($post->cover_image != '')
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="Cover Image">
                        @else
                            <img style="width:100%" src="/storage/cover_images/no_image_available.jpg" alt="Cover Image">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{ $post->created_at }} by <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></small>
                    </div>
                </div>
         
            </div>
        @endforeach
        @if(request('all'))
            {{$posts->links()}}
        @endif
    @else
        <p>No posts found.</p>
    @endif
@endsection