<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRatingController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'rank:User']);
    }

    public function store(Post $post, Request $request) {
        $this->validate($request, [
            'rating' => [
                'required',
                'integer',
                'between:0,10'
            ]
        ]);

        $post->ratings()->updateOrCreate(
            [
                'post_id'   => $post->id,
                'user_id'   => Auth::id(),
            ],
            [
                'stars'     => $request->rating,
            ]
        );


        return back();
    }

    public function destroy(Post $post, Request $request) {
        $request->user()->ratings()->where('post_id', $post->id)->delete();

        return back();
    }
}
