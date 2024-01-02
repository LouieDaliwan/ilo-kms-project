<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'fullname' => $this->fullname,
            'training_date' => !is_null($this->ilo_timestamp) ? $this->ilo_timestamp->toFormattedDateString() : null,
            'isBusinessRegistered' => $this->is_business_registered ? 'Yes' : 'No',
        ]);
    }
}
