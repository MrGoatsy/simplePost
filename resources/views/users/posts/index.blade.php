@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-100 p-6 m-6">
            <div class="p-2">
                <h1 class="text-3xl font-medium">{{$user->username}}</h1>
                Has made {{$posts->total()}} {{Str::plural('post', $posts->total())}} with a total of {{$user->getReceivedLikes()->count()}} {{Str::plural('like', $user->getReceivedLikes()->count())}}
            </div>
            <div class="p-2">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post="$post" />
                    @endforeach
                    {{ $posts->links() }}
                @else
                    {{$user->name}} has no posts.
                @endif
            </div>
        </div>
    </div>
@endsection