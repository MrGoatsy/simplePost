@props(['users' => $users])

@if ($users->count())
    <div class="table-responsive">
        <table class="table text-white" style="margin-bottom: 250px;">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                <th scope="col">Post count</th>
                <th scope="col">Action</th>
            </tr>
            @foreach ($users as $user)
                <tr style="vertical-align: middle;">
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->postCount}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Choose action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('users.posts', $user->username)}}">View posts</a></li>
                                <li><a class="dropdown-item" href="{{route('admin.users.warn', $user->username)}}">Warn</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
        </table>
    </div>
@endforeach
<div class="pagination justify-content-center ">
    {{$users->links()}}
</div>
@else
There are no users named like that
@endif
