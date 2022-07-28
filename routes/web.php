<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiPostController;


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
//API
Route::get('/api/posts',[ApiPostController::class,'index']);

Route::get('/',[PostsController::class,'index'])->middleware('auth');
Route::get('/posts',[PostsController::class,'index'])->middleware('auth');
Route::get('/posts/{post}',[PostsController::class,'show'])->middleware('auth');
Route::get('/post/create',[PostsController::class,'create'])->middleware('auth');
Route::get('/posts/{}',[PostsController::class,'create'])->middleware('auth');
Route::post('/posts',[PostsController::class,'store'])->middleware('auth');

//needs better route
Route::get('/user/posts',[PostsController::class,'user'])->middleware('auth');

//controls vote for Posts. direction of vote
Route::patch('/posts/{post}/voted/{direction}',[PostsController::class,'voted']);

Route::post('/posts/{post}/comment',[CommentController::class,'store']);


Auth::routes();

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
