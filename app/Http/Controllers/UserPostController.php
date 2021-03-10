<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller {
    public function index(User $user) {
        //$posts = $user->posts()->with(['user', 'likes'])->orderBy('created_at', 'desc')->paginate(100);
        //$posts = $user->posts()->with('user')->withCount('rating')->orderBy('created_at', 'desc')->paginate(100);
        $posts = $user->posts()->withCount([
            'ratings AS rated' => function ($query) {
                $query->select(DB::raw('stars AS rated'))->where('user_id', Auth::id())->toSql();
            }
        ])->withAvg('ratings', 'stars')->orderBy('posts.created_at', 'desc')->paginate(100);

        return view('users.posts.posts', [
            'user'  => $user,
            'posts' => $posts
        ]);
    }
}
