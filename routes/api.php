<?php

use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Wise\UploadActivityPlusController;
use App\Http\Controllers\Wise\UploadParticipantsController;

Route::group(['middleware' => config('fortify.middleware', ['auth:sanctum'])], function () {
    require(__DIR__.'/auth.php');

    Route::prefix('v1')->group(function () {
        Route::resource('users', UsersController::class);

        Route::post('upload-wise-participants', UploadParticipantsController::class)
            ->name('upload-wise-participants');

        Route::post('upload-wise-activity-plus', UploadActivityPlusController::class)
            ->name('upload-wise-activity-plus');
    });
});



