<?php

use App\Http\Controllers\Users\UsersController;

$routes = [
    '/wise.php',
    '/score.php'
];

Route::group(['middleware' => config('fortify.middleware', ['auth:sanctum'])], function () use($routes) {
    require(__DIR__.'/auth.php');

    Route::prefix('v1')->group(function () use ($routes) {
        Route::resource('users', UsersController::class);
        foreach ($routes as $route) {
            require(__DIR__."{$route}");
        }

    });
});



