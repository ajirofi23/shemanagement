<?php

use Illuminate\Support\Facades\Route;
// Removed unused View facade import
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

// // Dashboard (opsional bila belum ada)
// Route::get('/she/dashboard', function () {
//     return view('welcome'); // ganti ke view dashboard Anda bila sudah ada
// })->name('she.dashboard');

// Hyari Hatto (opsional bila belum ada)
Route::get('/she/hyari-hatto', function () {
    return view('she.hyari_hatto'); // ganti ke view hyari hatto Anda bila sudah ada
})->name('she.hyarihatto');

// HALAMAN INSIDEN (tanpa controller)
Route::get('/she/insiden', function () {
    return view('SHE.insiden');
})->name('she.insiden');

// SHE - Insiden Form (no controller)
Route::get('/she/insiden/form', function () {
    return view('SHE.insiden_form');
})->name('she.insiden.form');

// Optional: handle submit without controller (demo)
// You can later replace this with real persistence logic.
Route::post('/she/insiden/store', function (\Illuminate\Http\Request $request) {
    return redirect()->route('she.insiden.form')->with('status', 'Laporan berhasil dikirim.');
})->name('she.insiden.store');
