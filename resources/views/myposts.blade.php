@extends('layout.default')
@section('content')

<?php $i = 1; ?>

<table class="table container">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tile</th>
        <th scope="col">Author</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th scope="row"> {{ $i++ }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            {{-- <td><a href="{{ 'delete/' . $post->id }}"  class="btn btn-primary">Delete</a></td> --}}
            <td>
            <form action="{{ url('deletePost/' . $post->id) }}" method="POST">
                @csrf
                <button type="subbmit" name="subbmit">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

@stop