<?php

namespace App\Imports\Wise;

use App\Models\Wise\Evaluation;
use Carbon\Carbon;
use Domain\Wise\Actions\FindParticipants;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class EvaluationImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return void
    */
    public function collection(Collection $rows): void
    {
        unset($rows[0]);

        $rows->each(function($row) {
            $user = FindParticipants::find($row);

            Evaluation::firstOrCreate([
                    'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
                    'wise_participant_id' => $user ? $user->id : null,
                    'employer_or_worker' => $row[5],
                ],
                [
                'wise_participant_id' => $user ? $user->id : null,
                'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
                'employer_or_worker' => $row[5],
                'date_of_training' => Carbon::parse($row[6])->format('Y-m-d') ?? null,
                'location' => $row[7],
                'evaluation_answers' => [
                    'The training objectives were met' => $row[8],
                    'Answer if you are an Employer: As an employer, I have an improved understanding of my legal duties and responsibilities related to OSH' => $row[9],
                    'Answer if you are WORKER: As a worker, I have an improved understanding of my legal duties and responsibilities related to OSH.' => $row[10],
                    'I have learned how to conduct hazard and risk assessment' => $row[11],
                    'I have acquired new knowledge on how to prevent and mitigate COVID-19 and other health hazards in the workplace' => $row[12],
                    'I will recommend this training to other MSMEs and informal businesses' => $row[13]
                ],
                'comments' => $row[14],
            ]);
        });
    }
}
