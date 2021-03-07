<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RankChecker {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$ranks) {
        if (!Auth::check()) {
            abort(401);
        }

        $userRank = Auth::user()->rank;
        $rankCheck = DB::table('userranks')->whereIn('rankName', $ranks)->select('rankValue', 'rankName')->orderBy('rankValue', 'desc')->get();

        foreach ($rankCheck as $rank) {
            if ($userRank >= $rank->rankValue) {
                return $next($request);
            }
        }

        return abort(403);
    }
}
