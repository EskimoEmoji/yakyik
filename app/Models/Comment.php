<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    use HasFactory;

    // Sum of votes
    public function commentScore(){
        return $this->hasMany(Vote::class,'comment_id')->sum('vote');
    }

    public function didVoteOnComment(){
        return $this->hasMany(Vote::class,'comment_id')->where('user_id',auth()->id())->first();
    }
}
