<?php

namespace App\Imports;

use App\Models\Wise\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class WiseEvaluationImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function collection(Collection $rows)
    {
        dd($rows);
        $rows->each(function($row) {
            Evaluation::firstOrCreate([
                'ilo_timestamp' => $row[0],
                'date_of_training' => $row[1],

            ]);
        });
    }
}
