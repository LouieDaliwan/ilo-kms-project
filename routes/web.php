<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShowAppPage;
use Illuminate\Support\Facades\Route;

//use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
//use Laravel\Fortify\RoutePath;

Route::get('/', [RedirectController::class, 'dashboard']);
Route::get('home', [RedirectController::class, 'dashboard'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [ShowAppPage::class, 'index'])->name('dashboard');
});

Route::any('/{any?}', [ShowAppPage::class, 'index'])->where('any', '.*');

$enableViews = config('fortify.views', false);
$limiter = config('fortify.limiters.login');

//// Authentication...
//Route::post(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'store'])
//    ->middleware(array_filter([
//        'guest:'.config('fortify.guard'),
//        $limiter ? 'throttle:'.$limiter : null,
//    ]));
////

//Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
//    ->name('logout');
