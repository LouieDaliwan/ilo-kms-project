<?php

use App\Http\Controllers\Wise\ActivityPlusController;
use App\Http\Controllers\Wise\EvaluationsController;
use App\Http\Controllers\Wise\FetchCommentsIndicatorThreeController;
use App\Http\Controllers\Wise\FetchCommentsIndicatorTwoController;
use App\Http\Controllers\Wise\IndicatorOneDataController;
use App\Http\Controllers\Wise\IndicatorThreeDataController;
use App\Http\Controllers\Wise\IndicatorTwoDataController;
use App\Http\Controllers\Wise\OverallCompletionController;
use App\Http\Controllers\Wise\ParticipantActivityPlusController;
use App\Http\Controllers\Wise\ParticipantEvaluationsController;
use App\Http\Controllers\Wise\ParticipantsController;
use App\Http\Controllers\Wise\ShowActivityPlusController;
use App\Http\Controllers\Wise\ShowParticipantController;
use App\Http\Controllers\Wise\UploadActivityPlusController;
use App\Http\Controllers\Wise\UploadEvaluationController;
use App\Http\Controllers\Wise\UploadIndicatorOneController;
use App\Http\Controllers\Wise\UploadIndicatorThreeController;
use App\Http\Controllers\Wise\UploadIndicatorTwoController;
use App\Http\Controllers\Wise\UploadParticipantsController;


Route::get('wise-overall', OverallCompletionController::class)
    ->name('wise-overall');

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

Route::get('/score-indicator-one-data', IndicatorOneDataController::class)
    ->name('indicator-one-data');

Route::post('/upload-score-indicator-one', UploadIndicatorOneController::class)
    ->name('upload-score-indicator-one');


Route::get('/wise-indicator-two-data', IndicatorTwoDataController::class)
    ->name('indicator-two-data');

Route::get('/wise-indicator-two-comments', FetchCommentsIndicatorTwoController::class)
    ->name('indicator-two-comments');

Route::post('/upload-wise-indicator-two', UploadIndicatorTwoController::class)
    ->name('upload-wise-indicator-two');


Route::get('/wise-indicator-three-data', IndicatorThreeDataController::class)
    ->name('indicator-three-data');

Route::get('/wise-indicator-three-comments', FetchCommentsIndicatorThreeController::class)
    ->name('indicator-three-comments');

Route::post('/upload-wise-indicator-three', UploadIndicatorThreeController::class)
    ->name('upload-wise-indicator-three');
