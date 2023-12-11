<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = parent::toArray($request);

        return collect(array_merge($user, [
            'firstname' => $this->first_name,
            'middlename' => $this->middle_name,
            'lastname' => $this->last_name,
            'displayname' => $this->fullname,
            'email' => $this->email,
            'details' => $this->metadata,
            'mobile_number' => $this->metadata['Mobile Phone']['value'] ?? null,
            'home_address' => $this->metadata['Home Address']['value'] ??  null,
            'isTemporaryPassword' => $this->is_temporary_password,
            'roles' => $this->roles->pluck('name')->toArray()[0] ?? null,
            'username' => $this->username,
            'avatar' => $this->avatar
        ]))->toArray();
    }
}
