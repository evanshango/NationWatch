<?php

namespace App\Http\Resources\Reply;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class ReplyCollection extends Resource
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
            'reply' => $this->reply,
            'time' => $this->created_at->format('Y-m-d H:i'),
            'by' => $this->user->name,
        ];
    }
}
