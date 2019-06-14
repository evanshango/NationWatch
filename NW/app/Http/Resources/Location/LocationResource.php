<?php

namespace App\Http\Resources\Location;

use App\Http\Resources\Post\PostCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class LocationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'posts' => PostCollection::collection($this->posts)
        ];
    }
}
