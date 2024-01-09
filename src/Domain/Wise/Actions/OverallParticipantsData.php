<?php

namespace Domain\Wise\Actions;

use App\Models\Wise\Participant;

class OverallParticipantsData
{
    public function __construct(
        protected $gender = Participant::GENDER,
        protected $sector = Participant::SECTOR,
        protected $position = Participant::POSITION,
    ){}

    public function __invoke(array $request = null)
    {
        $participants = Participant::select(['gender', 'business_sector', 'position']);

        if(request()->has('from') && request()->has('to')) {
            $participants = $participants->whereBetween('created_at', [request()->from, request()->to]);
        }

        $participants = $participants->get();

        foreach ($participants as $participant) {
            $this->gender[$participant->gender]++;
            $this->position[$participant->position]++;
            array_key_exists($participant->business_sector, $this->sector)
                ? $this->sector[$participant->business_sector]++
                : $this->sector['Others']++;
        }

        return [
            'total_participants' => $participants->count(),
            'gender' => $this->gender,
            'sector' => $this->sector,
            'position' => $this->position,
        ];
    }
}
