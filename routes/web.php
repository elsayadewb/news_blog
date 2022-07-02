<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\notificationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
 Route::get('send',"App\Http\Controllers\HomeController@sendNotification");
 Route::resource('notifications', notificationController::class)->middleware('auth'); //


Route::get('/home', function () {
    return view('home')->middleware('auth');;
});
Route::any('/dashboard ',"App\Http\Controllers\HomeController@dashboard");
Route::get('/',"App\Http\Controllers\HomeController@home");


Route::any('/store/comment',"App\Http\Controllers\HomeController@store_comment")->name('comment.store_comment')->middleware('auth');
 Route::resource('users', UserController::class)->middleware('auth'); //
Route::resource('posts', PostController::class)->middleware('auth'); //
Route::resource('comments', CommentController::class)->middleware('auth'); //

Route::get('/getdatalastweek ',"App\Http\Controllers\PostController@getdatalastweek");



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
