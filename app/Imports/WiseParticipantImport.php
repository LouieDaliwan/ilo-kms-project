<?php

namespace App\Imports;

use App\Models\Wise\Participant;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class WiseParticipantImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Participant([
            'first_name' => $row[0],
            'middle_name' => $row[1],
            'last_name' => $row[2],
            'email' => $row[3],
            'gender' => $row[4],
            'age' => $row[5],
            'phone_number' => $row[6],
            'position' => $row[7],
            'type_of_business' => $row[8],
            'business_sector' => $row[9],
            'is_business_registered' => $row[10],
            'registered_to' => $row[11],
            'beneficiary_of_gov_project' => $row[12],
            'government_agency' => $row[13],
        ]);
    }
}
