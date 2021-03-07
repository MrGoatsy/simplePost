<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostRatingController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Post $post, Request $request) {
        /*if ($post->ratedBy($request->user())) {
            return $this->destroy($post, $request);
            //return response(null, 409);
        }*/

        $post->ratings()->updateOrCreate(['post_id' => $post->id,], [
            'user_id'   => $request->user()->id,
            'stars'     => $request->rating,
        ]);


        return back();
    }

    public function destroy(Post $post, Request $request) {
        $request->user()->ratings()->where('post_id', $post->id)->delete();

        return back();
    }
}
