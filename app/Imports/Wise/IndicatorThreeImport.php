<?php

namespace App\Imports\Wise;

use App\Models\Score\IndicatorThree;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class IndicatorThreeImport implements ToCollection
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
        IndicatorThree::create([
            'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
            'is_read_privacy_statement' => $row[1] == 'Yes',
            'gender' => $row[2],
            'type_of_sector' => $row[3],
            'years_current_workplace' => $row[4],
            'job_function' => $row[5],
            'questions_answer' => [
                'first_question' => $row[6],
                'first_question_comment' => $row[7],
                'second_question' => $row[8],
                'second_question_comment' => $row[9],
                'third_question' => $row[10],
                'third_question_comment' => $row[11],
                'fourth_question' => $row[12],
                'fourth_question_comment' => $row[13],
            ],
            'comments' => $row[14],
        ]);
    }
}
