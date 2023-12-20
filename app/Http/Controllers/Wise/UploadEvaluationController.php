<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Imports\WiseEvaluationImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadEvaluationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
//        $request->file('file');

        try {
            Excel::import(new WiseEvaluationImport, storage_path('app/evaluation.xlsx'));

            return response()->json([
                'message' => 'Successfully imported evaluation data.',
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
