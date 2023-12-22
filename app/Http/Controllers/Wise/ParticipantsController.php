<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResources;
use Domain\Wise\Actions\ParticipantsListActions;

class ParticipantsController extends Controller
{
    public function __construct(public ParticipantsListActions $participantsListActions){}

    public function index()
    {
        return ParticipantResources::collection(($this->participantsListActions)());
    }
}
