<?php

use App\Http\Controllers\Score\IndicatorOneDataController;
use App\Http\Controllers\Score\UploadIndicatorOneController;


Route::get('/score-indicator-one-data', IndicatorOneDataController::class)
    ->name('indicator-one-data');

Route::post('/upload-score-indicator-one', UploadIndicatorOneController::class)
    ->name('upload-score-indicator-one');


