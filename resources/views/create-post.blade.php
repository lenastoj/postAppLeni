@extends('layout.default')
@section('content')


<div class="container">
    <h2>Create post:</h2>
    <form action="{{ url('create-post') }}" method="POST">
        @csrf
    <input type="text" name="title" placeholder="title">
    <textarea name="body" cols="30" rows="10" placeholder="content"></textarea>
    <button type="submit" name="submit">Submit</button>
    </form>
</div>
@stop