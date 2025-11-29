<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingMaterialsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/app', function () {
    return view('layouts.app');
});

// Login page + login submit
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// NEW: SHE dashboard route (no middleware; controller handles auth/role)
// SHE Dashboard (no controller)
Route::view('/she/dashboard', 'SHE.dashboard')->name('she.dashboard');

Route::view('/it/management-user', 'IT.managementuser')->name('it.managementuser');
Route::get('/she-policies', function () {
    return view('she-policies');
})->name('she.policies');



Route::get('/training-materials', [TrainingMaterialsController::class, 'index'])->name('training.materials');
