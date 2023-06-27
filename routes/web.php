<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\MembersController;
use App\Http\Controllers\AssignDgroupLeaderControlller;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function(){
//     return view('login');
// });

// Route::get('/register', function(){
//     return view('register');
// });

Route::resource('members', MembersController::class);
Route::put('/members/{member}/assign-dgroup-leader', AssignDgroupLeaderControlller::class);
