<?php

use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Wise\ParticipantsController;
use App\Http\Controllers\Wise\UploadActivityPlusController;
use App\Http\Controllers\Wise\UploadEvaluationController;
use App\Http\Controllers\Wise\UploadParticipantsController;


Route::group(['middleware' => config('fortify.middleware', ['auth:sanctum'])], function () {
    require(__DIR__.'/auth.php');

    Route::prefix('v1')->group(function () {
        Route::resource('users', UsersController::class);

        Route::get('wise-participants', [ParticipantsController::class, 'index'])
            ->name('wise-participants');

        Route::post('upload-wise-participants', UploadParticipantsController::class)
            ->name('upload-wise-participants');

        Route::post('upload-wise-activity-plus', UploadActivityPlusController::class)
            ->name('upload-wise-activity-plus');

        Route::post('upload-wise-evaluation', UploadEvaluationController::class)
            ->name('upload-wise-evaluation');
    });
});



