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

<<<<<<< HEAD




Route::view('/pic/dashboard', 'PIC.dashboard')->name('pic.dashboard');
Route::view('/pic/laporanhyarihatto', 'PIC.laporanhyarihatto')->name('pic.laporanhyarihatto');
Route::view('/pic/komitmenk3', 'PIC.komitmenk3')->name('pic.komitmenk3');
Route::put('/komitmen-k3/update/{id}', [KomitmenK3Controller::class, 'update'])->name('update.komitmenk3');
Route::view('/pic/safetypatroltemuan', 'PIC.safetypatroltemuan')->name('pic.safetypatroltemuan');
Route::view('/pic/safetyridingtemuan', 'PIC.safetyridingtemuan')->name('pic.safetyridingtemuan');
=======
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
>>>>>>> 155e3a25b7836bdbb4b598b092211ff39fb0737b
