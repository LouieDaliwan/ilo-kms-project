<?php

namespace Domain\SIYB\Actions;

use App\Models\SIYB\Agency;

class AgencySummary
{
    protected string $model = Agency::class;

    public function __invoke()
    {
        return $this->summaryData();
    }

    protected function summaryData()
    {
        return '';
    }
}
