<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use App\Http\Resources\SIYB\AgencyResource;
use Domain\SIYB\Actions\AgenciesList;

class ListAgenciesController extends Controller
{
    public function __construct(protected AgenciesList $agenciesList)
    {}
    public function __invoke()
    {
        return AgencyResource::collection(($this->agenciesList)());
    }
}
