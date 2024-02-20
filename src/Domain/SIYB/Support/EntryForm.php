<?php

namespace Domain\SIYB\Support;

trait  EntryForm
{
    protected array $listConnection = [
        'Constant high-speed connection (e.g., fiber, broadband,  cable or Wi-Fi)' => 'high-speed connection',
        'Constant but low-speed or unstable connection' => 'low-speed connection',
        'Buys prepaid data allowance as needed' => 'prepaid data allowance',
        'Connects through providers outside household (e.g., internet café, free wifi)'=> 'outside provider',
        'no internet at all' => 'no internet',
    ];

    protected array $entryForm = [
        'gender' => [
            'Male' => 0,
            'Female' => 0,
        ],
        'age' => [
            '16-25' => 0,
            '26-35' => 0,
            '36-45' => 0,
            '46-60' => 0,
            '>60' => 0,
        ],
        'digitalDevices' => [
            'Smartphone' => 0,
            'Tablet' => 0,
            'Laptop' => 0,
            'Desktop' => 0,
        ],
        'connection' => [
            'high-speed connection' => 0,
            'low-speed connection' => 0,
            'prepaid data allowance' => 0,
            'outside provider'=>0,
            'no internet' => 0,
        ]
    ];

    protected function entryForm($client, $latestResponse, $entryForm) : array
    {
        $entryForm['gender'][$client->gender] += 1;
        $entryForm['age'][$client->age] += 1;
        $entryForm['connection'][$this->listConnection[$latestResponse['level_of_internet_access_do_you_currently_have']]] += 1;
        $entryForm['digitalDevices'][explode(",",$latestResponse['digital_devices_do_you_have'])[0]] += 1;

        return $entryForm;
    }
}
