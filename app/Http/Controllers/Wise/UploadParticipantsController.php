<?php

namespace App\Http\Controllers\Wise;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadWiseParticipantsRequest;
use App\Imports\WiseParticipantImport;
use Exception;
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
        try {
            $this->importer->import(new WiseParticipantImport, $request->file('file'));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
