<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified'])->only(['store', 'update', 'destroy']);
    }

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

        $post = $request->user()->posts()->create([
            'content'   => $request->body
        ]);

        return redirect()->route('posts.show', [
            'post' => $post->id
        ]);
    }

    public function update(Request $request, Post $post) {
        # code...
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post'  => $post
        ]);
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }
}
