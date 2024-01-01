<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityPlusResources;
use Domain\Wise\Actions\ActivityPlus;
use Illuminate\Http\Request;

class FetchActivityPlusController extends Controller
{
    public function __construct(public ActivityPlus $activityPlus)
    {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return ActivityPlusResources::collection(($this->activityPlus)());
    }
}
