<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use Domain\Wise\Actions\OverallParticipantsData;
use Illuminate\Http\Request;

class OverallCompletionController extends Controller
{
    public function __construct(public OverallParticipantsData $overallParticipantsData){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return ($this->overallParticipantsData)(request()->all());
    }
}
