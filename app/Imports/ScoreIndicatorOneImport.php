<?php

namespace App\Imports;

use App\Models\Score\IndicatorOne;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ScoreIndicatorOneImport implements ToCollection
{
    /**
     * @param Collection $rows
     *
     * @return void
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
        IndicatorOne::create([
            'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
            'is_read_privacy_statement' => $row[1] == 'Yes',
            'gender' => $row[2],
            'country_workplace' => $row[3],
            'type_of_organization' => $row[4],
            'years_of_subject_training' => $row[6],
            'questions_answer' => [
                'first_question' => $row[7],
                'second_question' => $row[8],
                'third_question' => $row[9],
                'fourth_question' => $row[10],
                'fifth_question' => $row[11],
                'sixth_question' => $row[12],
            ],
            'cite_examples' => $row[13],
            'comments' => $row[14],
        ]);
    }
}
