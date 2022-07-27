<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post){

        // validate
        $attributes = request()->validate([
            'text'=>'required|min:3|max:200',
        ]);

//        ddd($post->id);

        // Need to get Post id
        $attributes['post_id'] = $post->id;
        $attributes['user_id'] = auth()->id();
        $attributes['votes'] = 0;

       Comment::create($attributes);

        return redirect($post->path());
    }
}
