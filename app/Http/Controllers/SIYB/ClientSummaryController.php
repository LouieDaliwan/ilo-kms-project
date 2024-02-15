<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use Domain\SIYB\Actions\ClientList;

class ClientSummaryController extends Controller
{
    public function __construct(public ClientList $clientList) {}
    public function __invoke()
    {
        return ($this->clientList)();
    }
}
