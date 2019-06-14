<?php

namespace App\Http\Resources\Location;

use App\Http\Resources\Post\PostCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class LocationCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $posts = PostCollection::collection($this->posts);
        return [
            'name' => $this->name,
            'code' => $this->code,
            'posts' => $posts
        ];
    }
}
