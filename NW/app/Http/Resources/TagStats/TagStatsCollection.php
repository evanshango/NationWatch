<?php

namespace App\Http\Resources\TagStats;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class TagStatsCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        $location = $this->location;

        return [
            'tag' => $this->tag->name,
            'points' => $this->points,

        ];
    }
}
