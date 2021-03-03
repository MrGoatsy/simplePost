<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller {
    public function index(User $user) {
        $posts = $user->posts()->with(['user', 'likes'])->orderBy('created_at', 'desc')->paginate(100);

        return view('users.posts.posts', [
            'user'  => $user,
            'posts' => $posts
        ]);
    }
}
