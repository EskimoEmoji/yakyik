<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'text'=> $this->text,
            'location'=> $this->location,
            'comments'=> $this->comments,
            'created_at' => $this->created_at->diffForHumans(),
            'votes' => $this->votes,
        ];
    }
}
