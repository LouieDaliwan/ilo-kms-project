<?php

namespace App\Http\Responses;

use App\Models\User;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        return $request->wantsJson()
            ? response()->json(['two_factor' => false, 'auth' => $user])
            : redirect()->intended(Fortify::redirects('login'));
    }
}
