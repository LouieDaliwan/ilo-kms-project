<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Models\Wise\Participant;
use Domain\Wise\Actions\EvaluationDataAction;
use Illuminate\Http\Request;

class ParticipantEvaluationsController extends Controller
{
    public function __construct(public EvaluationDataAction $evaluationDataAction) {}

    public function __invoke(Request $request, Participant $participant)
    {
        return ($this->evaluationDataAction)($request->all(), $participant);
    }
}

