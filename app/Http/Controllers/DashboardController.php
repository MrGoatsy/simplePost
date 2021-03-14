<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'rank:Admin']);
    }

    public function index() {
        $mainArray = [];
        $userArray = [];
        $postArray = [];

        for ($x = 1; $x <= 12; $x++) {
            $date = date("Y") . '-' . (($x < 10) ? '0' . $x : $x);

            $userArray[] .= User::where('created_at', 'LIKE', '%' . $date . '%')->count();
            $postArray[] .= Post::where('created_at', 'LIKE', '%' . $date . '%')->count();
        }

        $mainArray = [
            'users' => $userArray,
            'posts' => $postArray
        ];

        return view('admin.control.general', [
            'data'  => $mainArray
        ]);
    }

    public function usersView() {
        return view('admin.control.users');
    }

    public function userSearch(Request $request) {
        $users = User::where('username', 'LIKE', '%' . $request->searchUsers . '%')->withCount([
            'posts AS postCount' => function ($query) {
                $query->select(DB::raw("count(*) AS postCount"));
            }
        ])->paginate(100);

        return view('admin.control.users', [
            'users' => $users
        ]);
    }

    public function userWarnView(Post $post) {
        return view('admin.control.users.warn');
    }

    public function posts() {
        return view('admin.control.posts');
    }
}
