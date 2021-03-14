@extends('admin.index')

@section('adminContent')
    <h1>User control</h1>
    <hr />
    <form action="{{ route('admin.users.search') }}" method="GET">
        <div class="input-group">
            <input type="text" name="searchUsers" class="form-control alert-warning" placeholder="Search for a user..."
                aria-label="Search for a user..." aria-describedby="searchUsers"
                value="{{ isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '' }}" />
            <button class="btn btn-success bi bi-search" type="submit" id="search"> Search</button>
        </div>
    </form>
    @if (isset($_GET['searchUsers']))
        <x-userList :users="$users" />
    @endif
@endsection
