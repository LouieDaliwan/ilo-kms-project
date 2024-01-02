<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityPlusResources;
use App\Models\Wise\ActivityPlusReport;
use Illuminate\Http\Request;

class ShowActivityPlusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, ActivityPlusReport $id)
    {
        return new ActivityPlusResources($id);
    }
}
