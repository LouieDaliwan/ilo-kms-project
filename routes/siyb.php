<?php


use App\Http\Controllers\SIYB\ListAgenciesController;
use App\Http\Controllers\SIYB\UploadStatusAgencyController;

Route::get('/siyb-agencies', ListAgenciesController::class)
    ->name('siyb-agencies');

Route::post('/upload-siyb-status-agency', UploadStatusAgencyController::class)
    ->name('upload-status-agency');
