@props(['posts' => $posts])

@foreach ($posts as $post)
    @if (Route::current()->getName() == 'posts.show')
        <?php $post = $posts[0]; ?>    
    @endif
    <div class="m-2" style="color: white;">
        <a href="{{route('users.posts', $post->user)}}" style="text-decoration: none;">{{$post->user->username}}</a> &bull; <small>{{$post->created_at->diffForHumans()}}</small>
        <p class="p-2 mb-3" style="background: rgb(0, 0, 0); opacity: 90%; min-height: 100px;">{{$post->content}}</p>
    <div class="d-flex align-items-center">
            <table>
                <tr>
                    <td>
                <form class="float-start" id="form_{{$post->id}}">
                    @csrf
                    <fieldset class="rate" style="color: gray;" id="{{$post->id}}">
                        @for ($x = 10; $x > 0; $x--)
                            <input type="radio" id="rating{{$post->id}}_{{$x}}" name="rating" value="{{$x}}" {{($x-.5 <= $post->ratings_avg_stars) && ($post->ratings_avg_stars <= $x+.5) ? 'checked' : ''}} />
                            <label class="{{$x%2==1 ? 'half' : ''}}" for="rating{{$post->id}}_{{$x}}" title="{{$x/2}}"></label>
                        @endfor
                    </fieldset>
                </form>
                <script type="text/javascript">
                    $('#form_{{$post->id}} input').on('change', function() {
                        $('form#form_{{$post->id}}').submit();
                    });

                    $('form#form_{{$post->id}}').submit(function(e){
                        e.preventDefault();
                        var formData = new FormData($('#form_{{$post->id}}')[0]);
                        var x = "{{Auth::user()}}";
                        
                        $.ajax({
                            type: "POST",
                            url: "{{route('posts.rating', $post)}}",
                            data: formData,
                            success: function (data) {
                                $('.result_{{$post->id}}').html('You rated ' + $('#{{$post->id}} input[name=rating]:checked').val()/2);
                            },
                            error: function (data) {
                                if(x != ""){
                                    console.log('Rating error');
                                }
                                else{
                                    $(location).attr("href", "{{route('login')}}");
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            resetForm: true
                        });
                        return false;
                    });
                </script>
                <br />
                <div style="text-align: center;">
                    <div class="result_{{$post->id}}">
                        {{$post->rated ? 'You rated ' . $post->rated/2 : ''}}
                    </div>
                </div>
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
@if (Route::current()->getName() != 'posts.show')
    <div class="pagination justify-content-center ">
        {{$posts->links()}}
    </div>
@endif
<script>
    $(document).ready(function() {
        $("#liveToast").toast('show');
    });
</script>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div class="toast-body border border-5 border-danger alert-warning">
        @inject('UserRanks', 'App\Models\UserRanks')
        <span>You are logged in as a/an <strong>{{$UserRanks->getRankName(Auth::user())->rankName}}<strong></span>
    </div>
</div>
