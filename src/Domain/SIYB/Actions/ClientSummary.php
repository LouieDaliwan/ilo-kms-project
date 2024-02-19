<?php

namespace Domain\SIYB\Actions;

use App\Models\SIYB\Client;

class ClientSummary
{
    protected string $model = Client::class;

    public function __invoke()
    {
        return [];
    }
}
