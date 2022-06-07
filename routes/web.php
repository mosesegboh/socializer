<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'show'])->name('not-logged');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/create-tweet', [App\Http\Controllers\TweetController::class, 'createTweet'])->name('create-tweet');
    Route::get('/like-tweet/{id}', [App\Http\Controllers\TweetController::class, 'likeTweet'])->name('like-tweet');
    Route::get('/unlike-tweet/{id}', [App\Http\Controllers\TweetController::class, 'unlikeTweet'])->name('unlike-tweet');
    
    Route::name('view.')->group(function () {
        Route::get('/following', [App\Http\Controllers\UserController::class, 'viewFollowing'])->name('following');
        Route::get('/followers', [App\Http\Controllers\UserController::class, 'viewFollowers'])->name('followers');
        Route::get('/user-following/{id}', [App\Http\Controllers\UserController::class, 'viewUserFollowing'])->name('user-following');
        Route::get('/user-followers/{id}', [App\Http\Controllers\UserController::class, 'viewUserFollowers'])->name('user-followers');
        Route::get('/user', [App\Http\Controllers\UserController::class, 'viewUser'])->name('user');
    });

    Route::post('/search-friend', [App\Http\Controllers\UserController::class, 'searchFriend'])->name('search-friend');
    Route::get('/follow-user/{id}', [App\Http\Controllers\UserController::class, 'followUser'])->name('follow-user');  
    Route::get('/unfollow-user/{id}', [App\Http\Controllers\UserController::class, 'unfollowUser'])->name('unfollow-user');  
    Route::post('/share-tweet', [App\Http\Controllers\TweetController::class, 'shareTweet'])->name('share-tweet');  
});
