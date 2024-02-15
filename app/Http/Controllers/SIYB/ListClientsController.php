<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use App\Http\Resources\SIYB\ClientResource;
use Domain\SIYB\Actions\ClientList;

class ListClientsController extends Controller
{
    public function __construct(protected ClientList $clientList) {}

    public function __invoke()
    {
        return ClientResource::collection(($this->clientList)());
    }
}
