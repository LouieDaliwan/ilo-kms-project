<?php

use App\Http\Controllers\DashboardPageController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\RoutePath;

Route::get('/', fn () => redirect('/admin/dashboard'));
Route::get('/admin/dashboard', [DashboardPageController::class, 'index']);
Route::any('/{any?}', [DashboardPageController::class, 'index'])->where('any', '.*');

$enableViews = config('fortify.views', false);
$limiter = config('fortify.limiters.login');

// Authentication...

Route::post(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:'.config('fortify.guard'),
        $limiter ? 'throttle:'.$limiter : null,
    ]));

Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
