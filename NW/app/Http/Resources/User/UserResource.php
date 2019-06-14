<?php

namespace App\Http\Resources\User;

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
        $location = $this->location->name;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'profile' => $this->profile_pic,
            'year_of_birth' => $this->yob,
            'gender' => $this->gender,
            'reg_date' => $this->created_at->format('Y-m-d H:i'),
            'is_suspended' => $this->is_suspended,
            'location' => $location
        ];
    }
}
