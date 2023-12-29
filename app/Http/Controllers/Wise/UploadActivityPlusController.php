<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Imports\WiseActivityPlusImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadActivityPlusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            Excel::import(new WiseActivityPlusImport, $request->file('file')); //storage_path('app/plus_activity.xlsx')

            return response()->json([
                'message' => 'Successfully imported activity report data.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
