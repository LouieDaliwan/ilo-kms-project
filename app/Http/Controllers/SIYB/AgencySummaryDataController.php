<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use Domain\SIYB\Actions\AgencySummary;

class AgencySummaryDataController extends Controller
{
    public function __construct(protected AgencySummary $agencySummary)
    {

    }
    public function __invoke()
    {
        return ($this->agencySummary)();
    }
}
