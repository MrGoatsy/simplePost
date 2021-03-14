<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostRatingController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

//Email verification
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::post('/email/verification-notification', [VerificationController::class, 'send'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//Logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Posts
Route::get('/', [PostController::class, 'index'])->name('posts');
Route::post('/', [PostController::class, 'store']);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'updateView'])->name('posts.edit');
Route::patch('/posts/{post}/edit', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//Post likes
//Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
//Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy']);

//Post rating
Route::post('/posts/{post}/rating', [PostRatingController::class, 'store'])->name('posts.rating');

//User posts
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');

//Search
Route::get('/search', [SearchController::class, 'index'])->name('search.posts');

//Admin panel
Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
Route::get('/admin/users', [DashboardController::class, 'usersView'])->name('admin.users');
Route::get('/admin/users/search', [DashboardController::class, 'userSearch'])->name('admin.users.search');
Route::get('/admin/users/warn/{user:username}', [DashboardController::class, 'userWarn'])->name('admin.users.warn');
Route::get('/admin/posts', [DashboardController::class, 'posts'])->name('admin.posts');

//Home
Route::get('/home', function () {
    return view('home');
})->name('home');
