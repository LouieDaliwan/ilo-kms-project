<?php

use App\Http\Controllers\Score\FetchCommentsIndicatorThreeController;
use App\Http\Controllers\Score\FetchCommentsIndicatorTwoController;
use App\Http\Controllers\Score\IndicatorOneDataController;
use App\Http\Controllers\Score\IndicatorThreeDataController;
use App\Http\Controllers\Score\IndicatorTwoDataController;
use App\Http\Controllers\Score\UploadIndicatorOneController;
use App\Http\Controllers\Score\UploadIndicatorThreeController;
use App\Http\Controllers\Score\UploadIndicatorTwoController;


Route::get('/score-indicator-one-data', IndicatorOneDataController::class)
    ->name('indicator-one-data');

Route::post('/upload-score-indicator-one', UploadIndicatorOneController::class)
    ->name('upload-score-indicator-one');


Route::get('/score-indicator-two-data', IndicatorTwoDataController::class)
    ->name('indicator-two-data');

Route::get('/score-indicator-two-comments', FetchCommentsIndicatorTwoController::class)
    ->name('indicator-two-comments');

Route::post('/upload-score-indicator-two', UploadIndicatorTwoController::class)
    ->name('upload-score-indicator-two');


Route::get('/score-indicator-three-data', IndicatorThreeDataController::class)
    ->name('indicator-three-data');

Route::get('/score-indicator-three-comments', FetchCommentsIndicatorThreeController::class)
    ->name('indicator-three-comments');

Route::post('/upload-score-indicator-three', UploadIndicatorThreeController::class)
    ->name('upload-score-indicator-three');


