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
Route::view('/it/dashboard', 'IT.dashboard')->name('it.dashboard');


Route::get('/she-policies', function () {
    return view('she-policies');
})->name('she.policies');



Route::get('/training-materials', [TrainingMaterialsController::class, 'index'])->name('training.materials');

// Hyari Hatto page without controller
Route::get('/she/hyari-hatto', function () {
    return view('she.hyari_hatto');
})->name('she.hyarihatto');





Route::view('/pic/dashboard', 'PIC.dashboard')->name('pic.dashboard');
Route::view('/pic/laporanhyarihatto', 'PIC.laporanhyarihatto')->name('pic.laporanhyarihatto');
Route::view('/pic/komitmenk3', 'PIC.komitmenk3')->name('pic.komitmenk3');
Route::put('/komitmen-k3/update/{id}', [KomitmenK3Controller::class, 'update'])->name('update.komitmenk3');
Route::view('/pic/safetypatroltemuan', 'PIC.safetypatroltemuan')->name('pic.safetypatroltemuan');
Route::view('/pic/safetyridingtemuan', 'PIC.safetyridingtemuan')->name('pic.safetyridingtemuan');
