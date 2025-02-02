<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'  => [
                'required',
                'max:255'
            ],
            'username' => [
                'required',
                'max:255',
                'unique:users,username'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'confirmed'
            ]
        ]);

        $rank = !User::count() ? 999 : 1;

        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'rank'      => $rank
        ])->sendEmailVerificationNotification();

        Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        return redirect()->route('dashboard');
    }
}
