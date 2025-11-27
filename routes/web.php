<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/she/dashboard', [SheDashboardController::class, 'index'])
    ->name('she.dashboard');
