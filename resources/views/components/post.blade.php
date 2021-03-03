@props(['post' => $post])

<div class="mb-4">
    <a href="{{route('users.posts', $post->user)}}" class="font-bold">{{$post->user->username}}</a> &bull; <small>{{$post->created_at->diffForHumans()}}</small>
    <p>{{$post->content}}</p>
    <div class="flex items-center">
        @auth
            <form action="{{route('posts.likes', $post)}}" method="post" class="mr-1">
                @csrf
                @if ($post->likedBy(Auth::user()))
                    @method('DELETE')
                @endif
                <button type="submit" class="text-blue-500">&#128077;</button>
            </form>
        @endauth
        <span class="text-green-500">{{$post->likes->count()}} {{Str::plural('Like', $post->likes->count())}}</span>
    </div>
    <div class="flex items-center">
        @auth
            @can('delete', $post)
                <form action="{{route('posts.destroy', $post)}}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            @endcan
        @endauth
    </div>
</div>