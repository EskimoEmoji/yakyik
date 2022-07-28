<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Stevebauman\Location\Facades\Location;
use Location\Coordinate;
use Location\Distance\Vincenty;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function user(){
        $posts = Post::where('user_id', auth()->id())->latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    // Stores the POST
    public function store(){

        // validate
        $attributes = request()->validate([
            'text'=>'required|min:3|max:200',
        ]);

        $myIP = '76.249.156.44';
        $chi = '107.122.93.54';
        $CA = '149.142.201.252';
        $OH = '18.188.149.90';
        $ip = \request()->ip();
        $location = Location::get($chi);
//        ddd($CA);
        $locationData= [
            'ip' => $location->ip,
            'country' => $location->countryCode,
            'state' => $location->regionCode,
            'zipcode' => $location->zipCode,
            'city' => $location->cityName,
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,

        ];

        $attributes['user_id'] = auth()->id();
        $attributes['votes'] = 0;
        $attributes['location'] = json_encode($locationData);

        Post::create($attributes);

        return redirect('/posts');
    }

    //Stores the users VOTE for a post
    public function voted(Post $post, $direction){

        //Check if user voted
        $didVote = Vote::where('user_id',auth()->id())->where('post_id',$post->id)->first();

        // If voted
        if($didVote){
            if($didVote->vote == $direction){
                //delete vote
                $didVote->delete();
            } else{
                $didVote->vote = $direction;
                $didVote->save();
            }
        } else {
            //New vote
            Vote::create([
                'user_id'=>auth()->id(),
                'post_id'=>$post->id,
                'vote'=>$direction,
            ]);
        }

        return Redirect::back();
    }

}
