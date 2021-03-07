<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        return view('Dashboard');
    }
}
