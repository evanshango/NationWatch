<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class UserCollection extends Resource
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
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'profile_pic' => $this->profile_pic,
            'Year of birth' => $this->yob,
            'gender' => $this->gender,
            'regDate' => $this->created_at->format('Y-m-d H:i'),
            'location' => $this->location->name
        ];
    }
}
