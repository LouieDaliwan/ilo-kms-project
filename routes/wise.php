<?php

use App\Http\Controllers\Wise\EvaluationsController;
use App\Http\Controllers\Wise\ParticipantsController;
use App\Http\Controllers\Wise\UploadActivityPlusController;
use App\Http\Controllers\Wise\UploadEvaluationController;
use App\Http\Controllers\Wise\UploadParticipantsController;


Route::get('wise-participants', [ParticipantsController::class, 'index'])
    ->name('wise-participants');

Route::post('upload-wise-participants', UploadParticipantsController::class)
    ->name('upload-wise-participants');

Route::post('upload-wise-activity-plus', UploadActivityPlusController::class)
    ->name('upload-wise-activity-plus');

Route::get('wise-evaluations', EvaluationsController::class)
    ->name('wise-evaluations');

Route::post('upload-wise-evaluation', UploadEvaluationController::class)
    ->name('upload-wise-evaluation');
