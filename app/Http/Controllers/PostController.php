<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified'])->only(['store', 'updateView', 'update', 'destroy']);
    }

    public function index() {
        //$posts = Post::with('user')->orderBy('id', 'desc')->paginate(100);
        //$posts = Post::with('user')->withCount('likes')->orderBy('id', 'desc')->paginate(100);
        //$posts = Post::with('user')->withCount('ratings')->orderBy('posts.id', 'desc')->paginate(100);
        /*$posts = Post::with('user')->withCount([
            'ratings AS ratingAvg' => function ($query) {
                $query->select(DB::raw("AVG(stars) as ratingAvg"));
            }
        ])->orderBy('posts.created_at', 'desc')->paginate(100);*/

        $posts = Post::with('user')->withCount([
            'ratings AS rated' => function ($query) {
                $query->select(DB::raw('stars AS rated'))->where('user_id', Auth::id())->toSql();
            }
        ])->withAvg('ratings', 'stars')->orderBy('posts.created_at', 'desc')->paginate(100);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body'  => [
                'required',
                'max:250'
            ],
        ]);

        $post = $request->user()->posts()->create([
            'content'   => $request->body
        ]);

        return redirect()->route('posts.show', [
            'post' => $post->id
        ]);
    }

    public function updateView(Post $post) {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post'  => $post
        ]);
    }

    public function update(Request $request, Post $post) {
        $this->authorize('update', $post);

        $this->validate($request, [
            'body'  => [
                'required',
                'max:250'
            ],
        ]);

        Post::where([
            'id'        => $post->id,
            'user_id'   => Auth::id()
        ])->update([
            'content'   => $request->body
        ]);

        return redirect()->route('posts.show', $post->id)->with('message', 'Your post has been updated.');
    }

    public function show(Post $post) {
        /*$posts = Post::where('posts.id', '=', $post->id)->withCount([
            'ratings AS ratingAvg' => function ($query) {
                $query->select(DB::raw("AVG(stars) as ratingAvg"));
            }
        ])->get();*/

        $posts = Post::with('user')->withCount([
            'ratings AS rated' => function ($query) {
                $query->select(DB::raw('stars AS rated'))->where('user_id', Auth::id())->toSql();
            }
        ])->withAvg('ratings', 'stars')->where('posts.id', $post->id)->orderBy('posts.created_at', 'desc')->get();

        return view('posts.show', [
            'post'  => $posts
        ]);
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }
}
