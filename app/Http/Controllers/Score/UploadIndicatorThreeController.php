<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Imports\ScoreIndicatorThreeImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadIndicatorThreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            Excel::import(new ScoreIndicatorThreeImport, $request->file('file')); //storage_path('app/plus_activity.xlsx')

            return response()->json([
                'message' => 'Successfully imported indicator three data.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
