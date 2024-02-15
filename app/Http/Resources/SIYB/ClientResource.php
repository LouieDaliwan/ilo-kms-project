<?php

namespace App\Http\Resources\SIYB;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        return array_merge($data, [
           'fullname' => $this->fullname,
           'trainer' => $this->agency->name,
           'location' => $this->agency->agency_location,
           'trainer_batch_code' => $this->agency->batch_code,
        ]);
    }
}
