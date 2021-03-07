@props(['posts' => $posts])

@foreach ($posts as $post)
    @if (Route::current()->getName() == 'posts.show')
        <?php $post = $posts; ?>
    @endif
    <div class="m-2" style="color: white;">
        <a href="{{route('users.posts', $post->user)}}" style="text-decoration: none;">{{$post->user->username}}</a> &bull; <small>{{$post->created_at->diffForHumans()}}</small>
        <p class="p-2 mb-3" style="background: rgb(0, 0, 0); opacity: 90%; min-height: 100px;">{{$post->content}}</p>
        <div class="d-flex align-items-center">
            <table>
                <tr>
                    <td>
                <form action="{{route('posts.rating', $post)}}" method="post" class="float-start" id="{{$post->id}}">
                    @csrf
                    <fieldset class="rate" style="color: gray;" id="{{$post->id}}">
                        @for ($x = 10; $x > 0; $x--)
                            <input type="radio" id="rating{{$post->id}}_{{$x}}" name="rating" value="{{$x}}" onClick="this.form.submit();" {{($x-.5 <= $post->avgRating()) && ($post->avgRating() <= $x+.5) ? 'checked' : ''}} /><label class="{{$x%2==1 ? 'half' : ''}}" for="rating{{$post->id}}_{{$x}}" title="{{$x/2}}"></label>
                        @endfor
                    </fieldset>
                </form>
                    </td>
                    <td>
                        {{round($post->ratingAvg, 1)}}
                    </td>
                </tr>
            </table>
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
    <hr style="color: white;"/>
    @if (Route::current()->getName() == 'posts.show')
        @break
    @endif
@endforeach