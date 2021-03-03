<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'signed'])->only('verify');
        $this->middleware(['auth', 'throttle:6,1'])->only('send');
        $this->middleware('auth')->only('notice');
    }

    public function notice() {
        if (!Auth::user()->hasVerifiedEmail()) {
            return view('auth.verify_email');
        } else {
            return redirect('/');
        }
    }

    public function send(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('dashboard')->with('message', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request) {
        if (!Auth::user()->hasVerifiedEmail()) {
            $request->fulfill();
        }

        return redirect('/');
    }
}
