@extends('layouts.app')

@section('content')
    <div class="w-50 m-3 mx-auto" id="app">
        <ul class="list-group" >
            <li class="list-group-item active">Chat Room</li>
            <message v-for="value in chat.message"> @{{ value }}</message>
        </ul>
        <input style="width:100%;" type="text" class="form-conrol p-3" placeholder="Write something" v-model='message' @keyup.enter="send">
    </div>
@endsection