<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Imports\WiseParticipantImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Importer;

//use App\Http\Requests\UploadWiseParticipantsRequest;

class UploadParticipantsController extends Controller
{
    public function __construct(private Importer $importer)
    {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            Excel::import(new WiseParticipantImport, $request->file('file')); //storage_path('app/sample-wise.xlsx')

            return 'Successfully uploaded!';
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
