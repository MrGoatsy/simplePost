@extends('layouts.app')

@section('content')
    <div class="col-md-1">
    </div>
    <div class="col-md-10 bg-dark">
        <h1>Admin Panel</h1>
        <hr />
        <div class="row">
            <div class="col-md-1">
                <h1>Menu</h1>
                <hr />
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin') }}" class="nav-link active">Main</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link ">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts') }}" class="nav-link ">Posts</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-11">
                <div class="row">
                    @yield('adminContent')
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1">
    </div>
@endsection
