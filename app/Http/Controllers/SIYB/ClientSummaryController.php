<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use Domain\SIYB\Actions\ClientSummary;

class ClientSummaryController extends Controller
{
    /**
     * @param  ClientSummary  $clientSummary
     */
    public function __construct(public ClientSummary $clientSummary) {}


    public function __invoke()
    {
        return ($this->clientSummary)();
    }
}
