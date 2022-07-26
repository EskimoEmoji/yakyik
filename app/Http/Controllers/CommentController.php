<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Post $post){

        // validate
        $attributes = request()->validate([
            'text'=>'required',
        ]);

        // Need to get Post id
        $attributes['owner_id'] = 1;
        $attributes['votes'] = 0;

       Comment::create($attributes);

        return redirect('/posts/1');
    }
}
