<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadWiseParticipantsRequest;
use App\Imports\WiseParticipantImport;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Importer;

class UploadParticipantsController extends Controller
{
    public function __construct(private Importer $importer)
    {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadWiseParticipantsRequest $request)
    {
//        $request->file('file')
        try {
            $this->importer->import(new WiseParticipantImport, Storage::get('sample-wise.xlsx'));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
