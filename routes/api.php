<?php

use App\Http\Controllers\Users\AuthProfileController;
use App\Http\Controllers\Users\AuthProfileUpdateController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Resources\AuthResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::group(['middleware' => config('fortify.middleware', ['auth:sanctum'])], function () {
    Route::get('/auth-check', fn () => auth()->check() ?
        response()->json(['message' => 'Authenticated', 'auth' => new AuthResources(auth()->user())], 200) :
        response()->json(['message' => 'Unauthenticated'], 401));

    Route::get('/auth/user', function (Request $request) {
        $user = auth()->user();
        return json_encode([
            'auth' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    });

    Route::get('/auth-profile', AuthProfileController::class);
    Route::put('/auth-profile', AuthProfileUpdateController::class);

    Route::prefix('v1')->group(function () {
        Route::resource('users', UsersController::class);
    });

    Route::get('/roles', function() {
        return Role::get(['id', 'name']);
    });
});
