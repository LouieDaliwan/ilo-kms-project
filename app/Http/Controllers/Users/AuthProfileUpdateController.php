<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResources;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class AuthProfileUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'You are not logged in.',
            ], 401);
        }

        return new AuthResources($this->updateInformation($request));

    }

    protected function updateInformation($request)
    {
        $user = auth()->user();

        Validator::make($request->toArray(), [
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['string', 'max:255'], // 'nullable
            'suffixname' => ['string', 'max:255'], // 'nullable
            'prefixname' => ['string', 'max:255'], // 'nullable
            'lastname' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:255'],
            'home_address' => ['required', 'text'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
        ]);

        $user->forceFill([
            'first_name' => $request['firstname'],
            'middle_name' => $request['middlename'],
            'last_name' => $request['lastname'],
            'prefixname' => $request['prefixname'],
            'suffixname' => $request['suffixname'],
            'metadata' => [
                'Mobile Phone' => $request['mobile_number'],
                'Home Address' => $request['home_address'],
                'Age' => '',
                'Gender' => '',
            ],
            'email' => $request['email'],
        ])->save();

        return $user->fresh();
    }
}
