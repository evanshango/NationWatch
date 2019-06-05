<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class CommentCollection extends Resource
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
            'commentId' => $this->id,
            'description' => $this->description,
            'image' => $this->image,
            'date' => $this->created_at->format('Y-m-d H:i'),
            'replies' => $this->replies_count,
            'likes' => $this->comment_pluses_count,
            'reports' => $this->reports_count,
            'user' => [
                'by' => $this->user->name,
                'pic' => $this->user->profile_pic
            ]
        ];
    }
}
