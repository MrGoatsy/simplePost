<?php

namespace App\Http\Controllers;

use App\Mail\postLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    public function index() {
        return view('Dashboard');
    }
}
