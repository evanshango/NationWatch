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
        $upvotes = $this->upvotes_count;
        $downvotes = $this->downvotes_count;
        $reports = $this->reports_count;
        $location = $this->user->location->name;

        return [
            'postId' => $this->id,
            'mediaType' => $this->media_type,
            'media' => $this->media,
            'description' => $this->text,
            'date' => $this->created_at->format('Y-m-d H:i'),
            'isPositive' => $this->is_positive,
            'comments' => $this->comments_count,
            'upvotes' => $upvotes,
            'downvotes' => $downvotes,
            'reports' => $reports,
            'points' => $upvotes - $downvotes,
            'tags' => [
                'tag1' => $this->tag1->name,
                'tag2' => $this->tag2['name'],
                'tag3' => $this->tag3['name']
            ],
            'location' => $location,

        ];
    }
}
