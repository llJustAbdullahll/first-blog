<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    // return view('welcome');

    return 'Abdullah';
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
// we are acceptiong gitHub response
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    dd($user);
    // the logic to wither create a new user and log him in 
    // or log in an existent user in db
});