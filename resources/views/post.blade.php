@extends('layout.default')
@section('content')
<div class="container">

    <h1>Post</h1>
    <p>Title: {{ $post->title }}</p>
    <p>Post: {{ $post->body }}</p>

</div>
@stop