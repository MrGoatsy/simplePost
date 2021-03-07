<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPostController extends Controller {
    public function index(User $user) {
        //$posts = $user->posts()->with(['user', 'likes'])->orderBy('created_at', 'desc')->paginate(100);
        //$posts = $user->posts()->with('user')->withCount('rating')->orderBy('created_at', 'desc')->paginate(100);
        $posts = $user->posts()->with('user')->with('user')->withCount([
            'ratings AS ratingAvg' => function ($query) {
                $query->select(DB::raw("AVG(stars) as ratingAvg"));
            }
        ])->orderBy('posts.created_at', 'desc')->paginate(100);

        return view('users.posts.posts', [
            'user'  => $user,
            'posts' => $posts
        ]);
    }
}
