<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityPlusResources;
use App\Models\Wise\Participant;
use Domain\Wise\Actions\ActivityPlus;
use Illuminate\Http\Request;

class ParticipantActivityPlusController extends Controller
{
    public function __construct(public ActivityPlus $activityPlus)
    {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Participant $participant)
    {
        return ActivityPlusResources::collection(($this->activityPlus)([], $participant->id));
    }
}
