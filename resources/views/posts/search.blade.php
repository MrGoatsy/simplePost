@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 bg-dark">
    <h1>Search</h1><hr />
    @if ($posts->count())
        <x-post :posts="$posts" />
    @else
    There are no posts
    @endif
</div>
<div class="col-md-2">
</div>
@endsection