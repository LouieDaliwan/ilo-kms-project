<?php

namespace App\Imports;

use App\Models\Wise\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class WiseParticipantImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        unset($rows[0]);

        $rows->each(function($row) {
            if ($row[0] == "") {
                return;
            }
            Participant::firstOrCreate([
                'email' => $row[11],
                'last_name' => $row[2]
            ], [
                'first_name' => $row[3],
                'middle_name' => $row[4],
                'last_name' => $row[2],
                'suffix' => $row[5],
                'nickname' => $row[6],
                'email' => $row[11],
                'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
                'gender' => $row[7],
                'age' => $row[8],
                'position' => $row[9],
                'member_of' => $row[10],
                'phone_number' => $row[12],
                'home_address' => $row[13],
                'type_of_business' => $row[14],
                'business_sector' => $row[15],
                'is_business_registered' => ($row[16] != 'Yes') || 0,
                'registered_to' => $row[17],
                'beneficiary_of_gov_project' => ($row[18] != 'Yes') || 0,
                'government_agency' => $row[19],
            ]);
        });

    }
}

