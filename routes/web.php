<?php

use App\Models\User;
use App\Http\Controllers;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AddFriendshipController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AvatarController;

Route::get('/', function () {
    return view('welcome');
})->middleware('verified');

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show-more-post', [App\Http\Controllers\HomeController::class, 'show_more']);
Route::post('/', [App\Http\Controllers\PostController::class, 'postAdd']);
Route::post('/addcomment', [App\Http\Controllers\PostController::class, 'commentPost']);
Route::get('/getcomment', [App\Http\Controllers\PostController::class, 'getCommentPost']);
Route::get('/like', [App\Http\Controllers\PostController::class, 'LikePost']);
Route::get('/unlike', [App\Http\Controllers\PostController::class, 'unLikePost']);
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'Profile'])->name('profile');
Route::get('/add-friend', [App\Http\Controllers\AddFriendshipController::class, 'addFriend']);
Route::get('/delete-friend', [App\Http\Controllers\AddFriendshipController::class, 'deleteFriend']);
Route::get('/friend-request', [App\Http\Controllers\AddFriendshipController::class, 'friendRequest'])->name('friend-request');
Route::get('/confirm-friend', [App\Http\Controllers\AddFriendshipController::class, 'confirmFriend'])->name('confirm-friend');
Route::get('/friend', [App\Http\Controllers\AddFriendshipController::class, 'friend'])->name('friend');
Route::post('/profile', [App\Http\Controllers\AvatarController::class, 'avatarAdd']);
Route::get('/user-profile/{id}', [App\Http\Controllers\HomeController::class, 'userProfile'])->name('user-profile');