<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'profile_pic' => $this->profile_pic,
            'Year of birth' => $this->yob,
            'location' => [
                'name' => $this->location->name
            ]
        ];
    }
}
