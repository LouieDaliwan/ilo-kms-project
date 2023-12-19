<?php

namespace Domain\Wise\Actions;

use App\Models\Wise\Participant;

class FindParticipants
{
    public static function find($data) : ? Participant
    {
        return Participant::where('last_name', $data[1])
            ->where('first_name', $data[2])
            ->where('middle_name', $data[3])
            ->where('suffix', $data[4])
            ->first();
    }
}
