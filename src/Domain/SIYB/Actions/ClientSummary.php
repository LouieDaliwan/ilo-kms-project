<?php

namespace Domain\SIYB\Actions;

use App\Models\SIYB\Client;
use Domain\SIYB\Support\BusinessOwners;
use Domain\SIYB\Support\BusinessStart;
use Domain\SIYB\Support\EntryForm;

class ClientSummary
{
    use EntryForm, BusinessStart, BusinessOwners;

    protected string $model = Client::class;

    public function __invoke() : array
    {
        $query = $this->model::get();

        $entryForm = $this->entryForm;
        $businessStart = $this->businessStartData;
        $businessOwners = $this->businessOwnersData;

        foreach ($query as $client) {
            $latestResponse = $client->responses()->latest()->first()->metadata;

            $entryForm = $this->entryForm($client, $latestResponse, $entryForm);
            $businessStart = $this->businessStart($latestResponse, $businessStart);
            $businessOwners = $this->businessOwners($latestResponse, $businessOwners);
        }

        return [
            'entryForm' => $entryForm,
            'businessStart' => $businessStart,
            'businessOwners' => $businessOwners,
        ];
    }
}
