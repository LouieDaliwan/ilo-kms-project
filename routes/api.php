<?php

use App\Http\Controllers\Users\AuthProfileController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\RoutePath;

Route::group(['middleware' => config('fortify.middleware', ['auth:sanctum'])], function () {
    Route::get('/auth/user', function (Request $request) {
        $user = auth()->user();
        return json_encode([
            'auth' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    });

    Route::get('/auth-profile', AuthProfileController::class);

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put(RoutePath::for('user-profile-information.update', '/user/profile-information'), [ProfileInformationController::class, 'update'])
            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
            ->name('user-profile-information.update');
    }


    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put(RoutePath::for('user-password.update', '/user/password'), [PasswordController::class, 'update'])
            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
            ->name('user-password.update');
    }


    // Password Confirmation...
    Route::post(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'store'])
        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
        ->name('password.confirm');


    Route::prefix('v1')->group(function () {
        Route::resource('users', UsersController::class);
    });

    $enableViews = config('fortify.views', false);
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    // Password Reset...
    //    if (Features::enabled(Features::resetPasswords())) {
    //        if ($enableViews) {
    //            Route::get(RoutePath::for('password.request', '/forgot-password'), [PasswordResetLinkController::class, 'create'])
    //                ->middleware(['guest:'.config('fortify.guard')])
    //                ->name('password.request');
    //
    //            Route::get(RoutePath::for('password.reset', '/reset-password/{token}'), [NewPasswordController::class, 'create'])
    //                ->middleware(['guest:'.config('fortify.guard')])
    //                ->name('password.reset');
    //        }
    //
    //        Route::post(RoutePath::for('password.email', '/forgot-password'), [PasswordResetLinkController::class, 'store'])
    //            ->middleware(['guest:'.config('fortify.guard')])
    //            ->name('password.email');
    //
    //        Route::post(RoutePath::for('password.update', '/reset-password'), [NewPasswordController::class, 'store'])
    //            ->middleware(['guest:'.config('fortify.guard')])
    //            ->name('password.update');
    //    }


    // Email Verification...
    //    if (Features::enabled(Features::emailVerification())) {
    //        if ($enableViews) {
    //            Route::get(RoutePath::for('verification.notice', '/email/verify'), [EmailVerificationPromptController::class, '__invoke'])
    //                ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
    //                ->name('verification.notice');
    //        }
    //
    //        Route::get(RoutePath::for('verification.verify', '/email/verify/{id}/{hash}'), [VerifyEmailController::class, '__invoke'])
    //            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'signed', 'throttle:'.$verificationLimiter])
    //            ->name('verification.verify');
    //
    //        Route::post(RoutePath::for('verification.send', '/email/verification-notification'), [EmailVerificationNotificationController::class, 'store'])
    //            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'throttle:'.$verificationLimiter])
    //            ->name('verification.send');
    //    }





    //    // Two Factor Authentication...
    //    if (Features::enabled(Features::twoFactorAuthentication())) {
    //        if ($enableViews) {
    //            Route::get(RoutePath::for('two-factor.login', '/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'create'])
    //                ->middleware(['guest:'.config('fortify.guard')])
    //                ->name('two-factor.login');
    //        }
    //
    //        Route::post(RoutePath::for('two-factor.login', '/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'store'])
    //            ->middleware(array_filter([
    //                'guest:'.config('fortify.guard'),
    //                $twoFactorLimiter ? 'throttle:'.$twoFactorLimiter : null,
    //            ]));
    //
    //        $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
    //            ? [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'password.confirm']
    //            : [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')];
    //
    //        Route::post(RoutePath::for('two-factor.enable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'store'])
    //            ->middleware($twoFactorMiddleware)
    //            ->name('two-factor.enable');
    //
    //        Route::post(RoutePath::for('two-factor.confirm', '/user/confirmed-two-factor-authentication'), [ConfirmedTwoFactorAuthenticationController::class, 'store'])
    //            ->middleware($twoFactorMiddleware)
    //            ->name('two-factor.confirm');
    //
    //        Route::delete(RoutePath::for('two-factor.disable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'destroy'])
    //            ->middleware($twoFactorMiddleware)
    //            ->name('two-factor.disable');
    //
    //        Route::get(RoutePath::for('two-factor.qr-code', '/user/two-factor-qr-code'), [TwoFactorQrCodeController::class, 'show'])
    //            ->middleware($twoFactorMiddleware)
    //            ->name('two-factor.qr-code');
    //
    //        Route::get(RoutePath::for('two-factor.secret-key', '/user/two-factor-secret-key'), [TwoFactorSecretKeyController::class, 'show'])
    //            ->middleware($twoFactorMiddleware)
    //            ->name('two-factor.secret-key');
    //
    //        Route::get(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'index'])
    //            ->middleware($twoFactorMiddleware)
    //            ->name('two-factor.recovery-codes');
    //
    //        Route::post(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'store'])
    //            ->middleware($twoFactorMiddleware);
    //    }
});
