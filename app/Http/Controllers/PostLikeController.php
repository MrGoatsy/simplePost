<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Post $post, Request $request) {
        if ($post->likedBy($request->user())) {
            return $this->destroy($post, $request);
            //return response(null, 409);
        }
        if ($request->user()->likes()->where('post_id', $post->id)->count()) {
            $this->destroy($post, $request);
        }

        $post->likes()->create([
            'user_id'   => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request) {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
