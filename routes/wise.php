<?php

use App\Http\Controllers\Wise\ActivityPlusController;
use App\Http\Controllers\Wise\EvaluationsController;
use App\Http\Controllers\Wise\ParticipantActivityPlusController;
use App\Http\Controllers\Wise\ParticipantEvaluationsController;
use App\Http\Controllers\Wise\ParticipantsController;
use App\Http\Controllers\Wise\ShowActivityPlusController;
use App\Http\Controllers\Wise\ShowParticipantController;
use App\Http\Controllers\Wise\UploadActivityPlusController;
use App\Http\Controllers\Wise\UploadEvaluationController;
use App\Http\Controllers\Wise\UploadParticipantsController;


Route::get('wise-participants', [ParticipantsController::class, 'index'])
    ->name('wise-participants');

Route::post('upload-wise-participants', UploadParticipantsController::class)
    ->name('upload-wise-participants');

Route::get('wise-participants/{id}', ShowParticipantController::class)
    ->name('wise-participants-show');

Route::get('wise-participants/{participant}/activity-plus', ParticipantActivityPlusController::class)
    ->name('wise-participants-activity-plus');

Route::get('wise-participants/{participant}/evaluations', ParticipantEvaluationsController::class)
    ->name('wise-participants-evaluations');

Route::get('wise-activity-plus', ActivityPlusController::class)
    ->name('wise-activity-plus-list');

Route::get('wise-activity-plus/{id}', ShowActivityPlusController::class)
    ->name('wise-activity-plus-report');

Route::post('upload-wise-activity-plus', UploadActivityPlusController::class)
    ->name('upload-wise-activity-plus');

Route::get('wise-evaluations', EvaluationsController::class)
    ->name('wise-evaluations');

Route::post('upload-wise-evaluation', UploadEvaluationController::class)
    ->name('upload-wise-evaluation');
