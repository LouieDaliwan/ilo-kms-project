<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResources;
use Illuminate\Http\Request;

class AuthProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new AuthResources(auth()->user());
    }
}
