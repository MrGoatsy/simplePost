@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 bg-dark">
        <h1>{{$user->username}}</h1>
        Has made {{$posts->total()}} {{Str::plural('post', $posts->total())}} with a total of {{$user->getReceivedRatings()->count()}} {{Str::plural('vote', $user->getReceivedRatings()->count())}}
        @if ($posts->count())
                <x-post :posts="$posts" />
            {{$posts->links()}}
        @else
            {{$user->name}} has no posts.
        @endif
</div>
<div class="col-md-2">
</div>
@endsection