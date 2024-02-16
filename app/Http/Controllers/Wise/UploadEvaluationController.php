<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadWiseRequest;
use App\Imports\Wise\EvaluationImport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class UploadEvaluationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadWiseRequest $request)
    {
        try {
            Excel::import(new EvaluationImport, $request->file('file')); //storage_path('app/evaluation.xlsx')

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
