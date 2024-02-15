<?php


use App\Http\Controllers\SIYB\AgencySummaryDataController;
use App\Http\Controllers\SIYB\ListAgenciesController;
use App\Http\Controllers\SIYB\ListClientsController;
use App\Http\Controllers\SIYB\UploadClientsController;
use App\Http\Controllers\SIYB\UploadStatusAgencyController;

Route::get('/siyb-agencies', ListAgenciesController::class)
    ->name('siyb-agencies');

Route::post('/upload-siyb-status-agency', UploadStatusAgencyController::class)
    ->name('upload-status-agency');

Route::get('/siyb-agency-summary-data', AgencySummaryDataController::class)
    ->name('siyb-agency-summary-data');

Route::post("/upload-siyb-clients", UploadClientsController::class)
    ->name('upload-siyb-clients');

Route::get('/siyb-clients', ListClientsController::class)
    ->name('siyb-clients');

