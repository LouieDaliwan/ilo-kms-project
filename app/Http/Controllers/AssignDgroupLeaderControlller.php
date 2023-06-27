<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Domain\Dgroup\Actions\SaveDLeaderDetails;

class AssignDgroupLeaderControlller extends Controller
{
    public function __construct(protected SaveDLeaderDetails $saveDLeaderDetails,){}
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $member)
    {
        $member->assignRole('DGroup-Leader');
    }
}
