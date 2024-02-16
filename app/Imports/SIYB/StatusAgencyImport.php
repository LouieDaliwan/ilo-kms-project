<?php

namespace App\Imports\SIYB;

use App\Models\SIYB\Agency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StatusAgencyImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        unset($rows[0]);

        $data = $rows->toArray();

        foreach($data as $key => $row) {
            $this->store($row);
        }
    }

    /**
     * @param  mixed  $row
     * @return void
     */
    public function store(mixed $row): void
    {
        Agency::UpdateOrCreate([
                'batch_code' => $row[0],
            ],
            [
            'batch_code' => $row[0],
            'name' => $row[1],
            'agency_location' => $row[2],
            'agency' => trim(preg_split('/[\s,]|[-,]+/', $row[2])[0]),
            'no_of_planned_toe' => (int) $row[3],
            'estimated_msme_to_be_trained' => (int) $row[4],
            'no_of_toe_conducted_activity_report' => (int) $row[5],
            'no_msme_trained' => (int) $row[6],
            'remarks' => $row[7],
        ]);
    }
}
