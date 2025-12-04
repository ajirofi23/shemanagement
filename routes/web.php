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

// // HALAMAN INSIDEN (tanpa controller)
// Route::get('/she/insiden', function () {
//     return view('SHE.insiden')d
// })->name('she.insiden');
// // // SHE - Insiden Form (no controller)
// // Route::get('/she/insiden/form', function () {
// //     return view('SHE.insiden_form');
// // })->name('she.insiden.form');

// // SHE - Insiden Form (no controller)
// Route::get('/she/insiden/form', function () {
//     return view('SHE.insiden_form');
// })->name('she.insiden.form');

// Halaman daftar insiden
Route::get('/she/insiden', function () {
    return view('SHE.insiden');
})->name('she.insiden');

// Halaman form insiden
Route::get('/she/insiden/form', function () {
    return view('SHE.insiden_form');
})->name('she.insiden.form');

// Submit form insiden (POST)
Route::post('/she/insiden', function (\Illuminate\Http\Request $request) {
    // Validasi minimal
    $request->validate([
        'tanggal' => 'required|date',
        'jam' => 'required',
        'lokasi' => 'required|string|max:150',
        'kategori' => 'required|string',
        'departemen' => 'required|string',
        'kronologi' => 'required|string|max:3000',
    ]);

    // Sementara langsung redirect ke daftar insiden
    return redirect()->route('she.insiden')->with('status', 'Laporan berhasil dikirim!');
})->name('she.insiden.store');


Route::view('/pic/dashboard', 'PIC.dashboard')->name('pic.dashboard');
Route::view('/pic/laporanhyarihatto', 'PIC.laporanhyarihatto')->name('pic.laporanhyarihatto');
Route::view('/pic/komitmenk3', 'PIC.komitmenk3')->name('pic.komitmenk3');

Route::view('/pic/safetypatroltemuan', 'PIC.safetypatroltemuan')->name('pic.safetypatroltemuan');
Route::view('/pic/safetyridingtemuan', 'PIC.safetyridingtemuan')->name('pic.safetyridingtemuan');

// SHE – Komitmen K3 (no controller)
Route::view('/she/komitmen-k3', 'SHE.komitmenk3')->name('she.komitmenk3');

// section detail via route-only (no controller)
Route::get('/she/section/{section?}', function ($section = 'ENG') {
    return view('SHE.section', ['section' => $section]);
})->name('she.section');

Route::get('/komitmen-k3/section/{section}', function ($section) {
    // return a section page without using a controller
    return view('SHE.section', ['section' => $section]);
})->name('she.section'); // FIX: add missing semicolon

// Safety Riding page without controller
Route::get('/she/safety-riding', function () {
    return view('SHE.safetyriding');
})->name('she.safetyriding');

Route::get('/she/safety-patrol', function () {
    return view('SHE.safetypatrol');
})->name('she.safetypatrol');
