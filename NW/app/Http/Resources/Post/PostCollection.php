<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class PostCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'postId' => $this->id,
            'mediaType' => $this->media_type,
            'media' => $this->media,
            'description' => $this->text,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'is_positive' => $this->is_positive,
            'tags' => [
                'tag1' => $this->tag1->name,
                'tag2' => $this->tag2['name'],
                'tag3' => $this->tag3['name']
            ],
            'name' => $this->user->name,
            'location' => $this->user->location->name,
            'comments' => $this->comments_count

        ];
    }
}
