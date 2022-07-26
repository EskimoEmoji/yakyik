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

        $posts = Post::with('comments')->with('userVotes')->withSum('votes','vote')->latest()->get();
//        foreach ($posts as $post){
//            dd(empty($post->userVotes));
//        }
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
        $location = Location::get($ip);

        if($location){
            $locationData= [
                'ip' => $location->ip,
                'country' => $location->countryCode,
                'state' => $location->regionCode,
                'zipcode' => $location->zipCode,
                'city' => $location->cityName,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,

            ];
        } else {
            $locationData = null;
        }


        $attributes['user_id'] = auth()->id();
        $attributes['location'] = $location ? json_encode($locationData) : $locationData;

        Post::create($attributes);

        return redirect('/posts');
    }

    //Stores the users VOTE for a post
    public function voted(Post $post, $direction, $type, $commentID){

//        ddd($commentID);

        if($type == 'post'){
            //Check if user voted
            $didVote = Vote::where('user_id',auth()->id())->where('post_id',$post->id)->first();
        } else {
            $didVote = Vote::where('user_id',auth()->id())->where('comment_id',$commentID)->first();
        }



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
            if($type == 'post'){
                Vote::create([
                    'user_id'=>auth()->id(),
                    'post_id'=>$post->id,
                    'vote'=>$direction,
                    'comment_id'=>null,
                ]);
            } else { //Comment
                Vote::create([
                    'user_id'=>auth()->id(),
                    'post_id'=>null,
                    'vote'=>$direction,
                    'comment_id'=>$commentID,
                ]);
            }

        }

        return Redirect::back();
    }

}
