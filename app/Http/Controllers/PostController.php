<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function index() {
        $posts = Post::with('user', 'likes')->orderBy('created_at', 'desc')->paginate(100);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body'  => [
                'required',
                'max:250'
            ],
        ]);

        $request->user()->posts()->create([
            'content'   => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }
}
