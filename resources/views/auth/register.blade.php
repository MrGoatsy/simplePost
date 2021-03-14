@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 bg-dark">
    <h1>Register</h1><hr />
    <x-alert error="green" />
    <form action="{{ route('register') }}" method="POST" class="text-gray-900">
        @csrf
        <div class="mb-4">
            <label for="name" class="sr-only">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}">

            @error('name')
                <div style="color: red;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Your username" value="{{ old('username') }}">
            
        @error('username')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="sr-only">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Your email" value="{{ old('email') }}">

        @error('email')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Your password">

        @error('password')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="sr-only">Password confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Reap password">
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </form>
</div>
<div class="col-md-2">
</div>
@endsection