<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller {
    public function index(Request $request) {
        $posts = Post::with('user')->withCount([
            'ratings AS rated' => function ($query) {
                $query->select(DB::raw('stars AS rated'))->where('user_id', Auth::id())->toSql();
            }
        ])->withAvg('ratings', 'stars')->selectRaw("MATCH(content) AGAINST(?) AS relevance", [1 => $request->search])
            ->whereRaw("MATCH(content) AGAINST(? IN NATURAL LANGUAGE MODE)", [1 => $request->search])->orderBy('relevance', 'desc')->paginate(100);

        return view('posts.search', [
            'posts'    => $posts
        ]);
    }
}
