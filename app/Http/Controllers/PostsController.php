<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    public function index(){
       $posts = Post::all();
//        $posts = Post::latest()->filter(request(['search','category', 'user']))->paginate(6)->withQueryString();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){

        // validate
        $attributes = request()->validate([
            'text'=>'required',
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['votes'] = 0;

        Post::create($attributes);

        return redirect('/posts')->with('success','Your post has been created.');
    }

//    public function update(Post $post){
//
////        $post->update(['votes'=>6969]);
//
//        return redirect('/posts');
//
//    }
}
