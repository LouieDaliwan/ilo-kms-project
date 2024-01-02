<?php

namespace App\Imports;

use App\Models\Wise\ActivityPlusReport;
use Domain\Wise\Actions\FindParticipants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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

        $data = $rows->toArray();

        foreach($data as $key => $row) {
            $user = FindParticipants::find($row);

            ActivityPlusReport::create([
                'ilo_timestamp' => Date::excelToDateTimeObject(intval($row[0]))->format('Y-m-d H:i:s'),
                'wise_participant_id' => !is_null($user) ? $user->id :
                    null,
                'company_name' => $row[5] ?? null,
                 'representation' => $row[2] ?? null,
                 'date_of_training' => Date::excelToDateTimeObject(intval($row[8]))->format('Y-m-d') ?? null,
                 'venue' => $row[9] ?? null,
                 'action_checklist_type' => $row[10] ?? null,
                 'good_points_identified' => $row[11] ?? null,
                 'points_to_be_improved' => $row[12] ?? null,
                 'action_item_1' => [
                     'question' => $row[13] ?? null,
                     'what' => $row[14] ?? null,
                     'who' => $row[15] ?? null,
                     'when' => $row[16] ?? null,
                 ],
                 'action_item_2' => [
                     'question' => $row[17] ?? null,
                     'what' => $row[18] ?? null,
                     'who' => $row[19] ?? null,
                     'when' => $row[20] ?? null,
                 ],
                 'action_item_3' => [
                     'question' => $row[21] ?? null,
                     'what' => $row[22] ?? null,
                     'who' => $row[23] ?? null,
                     'when' => $row[24] ?? null,
                 ],
                 'link_pictures' => $row[25] ?? null,
             ]);
        }
    }
}
