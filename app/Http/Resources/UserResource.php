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
            'id' => $this->id,
            'displayname' => $this->fullname,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'modified_at' => $this->updated_at->diffForHumans() ?? null,
            'role' => null,
        ]))->toArray();
    }
}
