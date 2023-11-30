<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInformationRequest;
use App\Http\Resources\AuthResources;


class AuthProfileUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateInformationRequest $request)
    {
        return new AuthResources($this->updateInformation($request));
    }

    protected function updateInformation($request)
    {
        $user = auth()->user();

        $user->forceFill(attributes: [
            'first_name' => $request['firstname'] ,
            'middle_name' => $request['middlename'] != 'null' ? $request['middlename'] : null,
            'last_name' => $request['lastname'] ,
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
