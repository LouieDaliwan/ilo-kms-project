<?php

use App\Http\Controllers\Users\UsersController;

Route::group(['middleware' => config('fortify.middleware', ['auth:sanctum'])], function () {
    require(__DIR__.'/auth.php');

    Route::prefix('v1')->group(function () {
        Route::resource('users', UsersController::class);

        require(__DIR__.'/wise.php');
    });
});



