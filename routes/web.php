<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',[PostsController::class,'index']);
Route::get('/posts/{post}',[PostsController::class,'show']);
Route::get('/post/create',[PostsController::class,'create']);
Route::post('/posts',[PostsController::class,'store']);
//Route::patch('/posts/{post}',[PostsController::class,'update']);

Route::post('/comments',[CommentController::class,'create']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
