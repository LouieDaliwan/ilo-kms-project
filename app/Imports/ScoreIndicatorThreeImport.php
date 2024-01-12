<?php

namespace App\Imports;

use App\Models\IndicatorThree;
use Maatwebsite\Excel\Concerns\ToModel;

class ScoreIndicatorThreeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new IndicatorThree([
            //
        ]);
    }
}
