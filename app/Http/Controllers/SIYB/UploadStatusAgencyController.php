<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use App\Imports\SIYBStatusAgencyImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadStatusAgencyController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            Excel::import(new SIYBStatusAgencyImport, $request->file('file')); //storage_path('app/plus_activity.xlsx')

            return response()->json([
                'message' => 'Successfully imported Status Agency data.',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
