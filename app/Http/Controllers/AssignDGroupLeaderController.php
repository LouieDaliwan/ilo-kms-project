<?php

namespace App\Http\Controllers;

use App\Models\User;
use Domain\Dgroup\Actions\SaveDLeaderDetails;
use Illuminate\Http\Request;

class AssignDgroupLeaderControlller extends Controller
{
    public function __construct(protected SaveDLeaderDetails $saveDLeaderDetails)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $member)
    {
        $member->assignRole('DGroup-Leader');

        return ($this->saveDLeaderDetails)($member);
    }
}
