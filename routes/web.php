<?php

use App\Http\Controllers\Users\AddMemberController;
use App\Http\Controllers\Users\IndexMembersController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function(){
//     return view('login');
// });

// Route::get('/register', function(){
//     return view('register');
// });

Route::get('/members', IndexMembersController::class)->name('members.index');
Route::post('/add-members', AddMemberController::class);
