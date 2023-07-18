<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardPageController;
use App\Http\Controllers\Users\MembersController;
use App\Http\Controllers\AssignDgroupLeaderControlller;

Route::get('/', fn() => redirect('/admin/dashboard'));

Route::get('/admin/dashboard', [DashboardPageController::class, 'index']);

Route::any('/{any?}', [DashboardPageController::class, 'index'])->where('any', '.*');

// Route::get('/login', function(){
//     return view('login');
// });

// Route::get('/register', function(){
//     return view('register');
// });



Route::resource('members', MembersController::class);
Route::put('/members/{member}/assign-dgroup-leader', AssignDgroupLeaderControlller::class);
