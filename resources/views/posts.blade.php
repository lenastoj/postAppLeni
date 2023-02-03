@extends('layout.default')
@section('content')

<div class="container">
    <h1>Posts</h1>
    @foreach ($posts as $post)
    <p>Title: <a href="/post/{{ $post->id }}">{{ $post->title }}</a></p>
    <p>Post: {{ $post->body }}</p>
    {{-- <p>{{ $post->id }}</p> --}}
    @endforeach

</div>



@stop