<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Imports\Wise\IndicatorOneImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadIndicatorOneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            Excel::import(new IndicatorOneImport, $request->file('file')); //storage_path('app/plus_activity.xlsx')

            return response()->json([
                'message' => 'Successfully imported indicator one data.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
