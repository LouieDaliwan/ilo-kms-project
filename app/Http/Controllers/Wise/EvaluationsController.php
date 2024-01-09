<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use Domain\Wise\Actions\EvaluationDataAction;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function __construct(public EvaluationDataAction $evaluationDataAction){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return ($this->evaluationDataAction)($request->all());
    }
}
