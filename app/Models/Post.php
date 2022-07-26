<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function comments(){
        return $this->hasMany(Comment::class,'user_id')->latest();
    }

    public function increment($column, $amount = 1, array $extra = [])
    {
        return parent::increment($column, $amount, $extra); // TODO: Change the autogenerated stub
    }
}
