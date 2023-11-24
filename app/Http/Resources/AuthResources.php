<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'displayname' => $this->fullname,
            'email' => $this->email,
            //'roles' => $this->roles,
            //'permissions' => $this->roles()->permissions,
            'username' => $this->username,
            'avatar' => $this->avatar
        ]);
    }
}
