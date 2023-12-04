<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShowAppPage;
use Illuminate\Support\Facades\Route;

Route::get('/', [RedirectController::class, 'dashboard']);
Route::get('home', [RedirectController::class, 'dashboard'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [ShowAppPage::class, 'index'])->name('dashboard');
});

Route::any('/{any?}', [ShowAppPage::class, 'index'])->where('any', '.*');
