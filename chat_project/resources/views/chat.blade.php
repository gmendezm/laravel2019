@extends('layouts.app')

@section('content')
    <div class="w-50 m-3 mx-auto" id="app">
        <ul class="list-group" >
            <li class="list-group-item active">Chat Room</li>
            <li class="list-group-item">Message Example</li>
            <input type="text" class="form-conrol p-3" placeholder="Write something" v-model='message'>
        </ul>
    </div>
@endsection