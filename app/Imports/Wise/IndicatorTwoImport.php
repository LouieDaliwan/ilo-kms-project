<?php

namespace App\Imports\Wise;

use App\Models\Score\IndicatorTwo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class IndicatorTwoImport implements ToCollection
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
        IndicatorTwo::create([
            'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
            'is_read_privacy_statement' => $row[1] == 'Yes',
            'gender' => $row[2],
            'type_of_organization' => $row[3],
            'years_of_subject_training' => $row[4],
            'questions_answer' => [
                'first_question' => $row[5],
                'first_question_comment' => $row[6],
                'second_question' => $row[7],
                'second_question_comment' => $row[8],
                'third_question' => $row[9],
            ],
        ]);
    }
}
