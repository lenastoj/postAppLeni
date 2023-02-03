@extends('layout.default')

@section('content')

 <form class="container mb-5" action="{{ url('signin') }}" method="POST">
    @csrf
    <div class="mb-3">
      <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
      <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>

@endsection