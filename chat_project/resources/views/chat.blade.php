@extends('layouts.app')

@section('content')
    <div class="w-50 m-3 mx-auto" id="app">
        <div class="list-group-item active">Chat Room</div>
        <ul class="list-group chat-window" v-chat-scroll>
            <message v-for="value in chat.message"> @{{ value }}</message>
        </ul>
        <input style="width:100%;" type="text" class="form-control p-3" placeholder="Write something" v-model='message' @keyup.enter="send">
    </div>
@endsection