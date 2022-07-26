<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Stevebauman\Location\Facades\Location;

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
        $dummyIP = '76.249.156.44';
        $ip = \request()->ip();
        $data = Location::get($dummyIP);
        $locationData= [
            'ip' => $data->ip,
            'country' => $data->countryCode,
            'state' => $data->regionCode,
            'zipcode' => $data->zipCode,
            'city' => $data->cityName,
        ];
        $attributes['location'] = json_encode($locationData);

        Post::create($attributes);

        return redirect('/posts')->with('success','Your post has been created.');
    }

}
