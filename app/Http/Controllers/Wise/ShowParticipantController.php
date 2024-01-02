<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResources;
use App\Models\Wise\Participant;
use Illuminate\Http\Request;

class ShowParticipantController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Participant $id)
    {
        return new ParticipantResources($id);
    }
}
