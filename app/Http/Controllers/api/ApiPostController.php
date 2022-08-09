<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    //API
    public function index(){
//        return PostResource::collection(Post::latest()->get());
//        return Post::with('comments')->with('votes')->get();
        return Post::with('comments')->with('userVotes')->withSum('votes','vote')->latest()->get();
    }
}
