<?php

namespace App\Imports;

use App\Models\Wise\Participant;
use App\Models\Wise\PlusActivityReport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class WiseActivityPlusImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function collection(Collection $rows)
    {
        unset($rows[0]);
        $rows->each(function($row) {
            $user = $this->findParticipant($row);

            dd($row);
             PlusActivityReport::create([
                'ilo_timestamp' => Carbon::parse($row[0])->format('Y-m-d H:i:s'),
                'wise_participant_id' => !is_null($user) ? $user->id : null,
                'company_name' => $row[5],
                 'representation' => $row[2],
                 'date_of_training' => Carbon::parse($row[8])->format('Y-m-d'),
                 'venue' => $row[9],
                 'action_checklist_type' => $row[10],
                 'good_points_identified' => $row[11],
                 'points_to_be_improved' => $row[12],
                 'action_item_1' => [
                     'question' => $row[13],
                     'what' => $row[14],
                     'who' => $row[15],
                     'when' => $row[16],
                 ],
                 'action_item_2' => [
                     'question' => $row[17],
                     'what' => $row[18],
                     'who' => $row[19],
                     'when' => $row[20],
                 ],
                 'action_item_3' => [
                     'question' => $row[21],
                     'what' => $row[22],
                     'who' => $row[23],
                     'when' => $row[24],
                 ],
             ]);
        });
    }

    protected function findParticipant($row)
    {
        return Participant::where('last_name', $row[1])
            ->where('first_name', $row[2])
            ->where('middle_name', $row[3])
            ->where('suffix', $row[4])
            ->first();
    }
}
