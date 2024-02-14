<?php

namespace App\Http\Controllers\SIYB;

use App\Http\Controllers\Controller;
use App\Imports\SIYB\UploadClientsImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadClientsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            Excel::import(new UploadClientsImport, $request->file('file'));

            return response()->json([
                'message' => 'Successfully imported clients data.',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
