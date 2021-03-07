@props(['posts' => $posts])

@foreach ($posts as $post)
@if (Route::current()->getName() == 'posts.show')
<?php $post = $posts; ?>
@endif
<div class="m-2" style="color: white;">
    <a href="{{route('users.posts', $post->user)}}" style="text-decoration: none;">{{$post->user->username}}</a> &bull; <small>{{$post->created_at->diffForHumans()}}</small>
    <p class="p-2 mb-3" style="background: rgb(0, 0, 0); opacity: 90%; min-height: 100px;">{{$post->content}}</p>
    <div class="d-flex align-items-center">
        <div class="p-2 bd-highlight" style="width: 40px;">
            <form action="{{route('posts.likes', $post)}}" method="post" class="float-start">
                @csrf
                <button type="submit" class="bg-transparent border-0 bi bi-hand-thumbs-up-fill" style="color: white; font-size: 25px;"></button>
            </form>
        </div>
        <div class="p-2 bd-highlight align-items-center"><span>{{$post->likeCount()}} {{Str::plural('Like', $post->likeCount())}}</span></div>
        <div class="ms-auto p-2 bd-highlight">
            @if(Route::current()->getName() != 'posts.show')
            <a href="{{route('posts.show', $post)}}" class="btn btn-success float-end ms-2">View</a>
            @endif
            @auth
            @can('UPDATE', $post)
            <a href="{{route('posts.edit', $post)}}" class="btn btn-warning float-end ms-2">Edit</a>
            @endcan
            @can('DELETE', $post)
            <form action="{{route('posts.destroy', $post)}}" method="post" class="float-end ms-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endcan
            @endauth
        </div>
    </div>
</div>
<hr style="color: white;" />
@if (Route::current()->getName() == 'posts.show')
@break
@endif
@endforeach