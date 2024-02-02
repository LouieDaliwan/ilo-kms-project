<?php

namespace App\Imports\SIYB;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UploadClientsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
