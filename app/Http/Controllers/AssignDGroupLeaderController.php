<?php

namespace App\Http\Controllers;

use App\Models\User;
use Domain\Dgroup\Actions\SaveDLeaderDetails;
use Exception;
use Illuminate\Http\Request;

class AssignDGroupLeaderController extends Controller
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

        try {
            return ($this->saveDLeaderDetails)($member);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
