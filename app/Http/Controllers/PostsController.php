<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Stevebauman\Location\Facades\Location;
use Location\Coordinate;
use Location\Distance\Vincenty;

class PostsController extends Controller
{
    public function index(){
//       $posts = Post::whereNotNull('location')->get();
        $posts = Post::latest()->get();
        $votes = Vote::latest()->get();
        return view('posts.index', compact('posts','votes'));
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

        $myIP = '76.249.156.44';
        $CA = '149.142.201.252';
        $OH = '18.188.149.90';
        $ip = \request()->ip();
        $location = Location::get($CA);
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

    public function voted(Post $post, $direction){

        $userID = auth()->id();

        $attributes= [
            'user_id'=>$userID,
            'post_id'=>$post->id,
            'vote'=>$direction,
        ];

        foreach ($post->voters as $vote){
            // If is a current voter
            if($vote->user_id === $userID){
                //Already Voted same direction
                if($vote->vote ===  (int)$direction){
                    return redirect('/posts');
                } else{
                    //Update attributes
                    $vote->update($attributes);

                    if($direction === '1'){
                        $post->increment('votes',2);
                    } else {
                        $post->decrement('votes',2);
                    }

                    return redirect('/posts');
                }
            }
        }


        //Did not vote YET
        if($direction === '1'){
            //Increase
            $post->increment('votes');
        } else{
            //decrease
            $post->decrement('votes');
        }

        // Cast New Vote
        Vote::create($attributes);

        return redirect('/posts');
    }

}
