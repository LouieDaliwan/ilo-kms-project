<?php


use App\Http\Controllers\SIYB\UploadStatusAgencyController;

Route::post('/upload-status-agency', UploadStatusAgencyController::class)
    ->name('upload-status-agency');
