@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 bg-dark">
    @if (session('status'))
        <div class="alert alert-danger">
            <p>{{session('status')}}</p>
        </div>
    @endif
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST" class="text-gray-900 focus:outline-none mt-2">
        @csrf
        <div class="mb-4">
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Your username" value="{{ old('username') }}">
            
        @error('username')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Your password">

        @error('password')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember" class="text-white" >Remember me</label>
        </div>
    </form>
</div>
<div class="col-md-2">
</div>
@endsection