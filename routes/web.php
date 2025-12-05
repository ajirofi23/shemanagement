<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingMaterialsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IT\DashboardController;
use App\Http\Controllers\IT\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Home bisa diakses tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');

// Layout test
Route::get('/app', function () {
    return view('layouts.app');
});

// LOGIN – hanya untuk tamu (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
});

<<<<<<< HEAD

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | IT ROUTES (Login + Permission Required)
    |--------------------------------------------------------------------------
    */
    Route::prefix('it')->middleware('permission')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/management-user', [UserController::class, 'index']);
    });
    Route::get('/management-user', [UserController::class, 'index']);
    Route::post('it/management-user/store', [UserController::class, 'store']);
    Route::get('/it/management-user/edit/{id}', [UserController::class, 'edit']);
    Route::put('/it/management-user/update/{id}', [UserController::class, 'update']);
    Route::delete('it/management-user/destroy/{id}', [UserController::class, 'destroy']);
    /*
    |--------------------------------------------------------------------------
    | ROUTES SHE (Login Only, No Permission)
    |--------------------------------------------------------------------------
    */
    Route::view('/she/dashboard', 'SHE.dashboard')->name('she.dashboard');

    Route::get('/she-policies', function () {
        return view('she-policies');
    })->name('she.policies');

    Route::get('/training-materials', [TrainingMaterialsController::class, 'index'])
        ->name('training.materials');

    // Hyari Hatto
    Route::get('/she/hyari-hatto', function () {
        return view('she.hyari_hatto');
    })->name('she.hyarihatto');

    // Insiden
    Route::get('/she/insiden', function () {
        return view('SHE.insiden');
    })->name('she.insiden');

    Route::get('/she/insiden/form', function () {
        return view('SHE.insiden_form');
    })->name('she.insiden.form');

    Route::post('/she/insiden', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|string|max:150',
            'kategori' => 'required|string',
            'departemen' => 'required|string',
            'kronologi' => 'required|string|max:3000',
        ]);
        return redirect()->route('she.insiden')
            ->with('status', 'Laporan berhasil dikirim!');
    })->name('she.insiden.store');

    // Komitmen K3
    Route::view('/she/komitmen-k3', 'SHE.komitmenk3')->name('she.komitmenk3');

    // Section
    Route::get('/she/section/{section?}', function ($section = 'ENG') {
        return view('SHE.section', ['section' => $section]);
    })->name('she.section');

    Route::get('/komitmen-k3/section/{section}', function ($section) {
        return view('SHE.section', ['section' => $section]);
    })->name('she.section');

    // Safety pages
    Route::get('/she/safety-riding', function () {
        return view('SHE.safetyriding');
    })->name('she.safetyriding');

    Route::get('/she/safety-patrol', function () {
        return view('SHE.safetypatrol');
    })->name('she.safetypatrol');


    /*
    |--------------------------------------------------------------------------
    | PIC ROUTES
    |--------------------------------------------------------------------------
    */
    Route::view('/pic/dashboard', 'PIC.dashboard')->name('pic.dashboard');
    Route::view('/pic/laporanhyarihatto', 'PIC.laporanhyarihatto')->name('pic.laporanhyarihatto');
    Route::view('/pic/komitmenk3', 'PIC.komitmenk3')->name('pic.komitmenk3');
    Route::view('/pic/safetypatroltemuan', 'PIC.safetypatroltemuan')->name('pic.safetypatroltemuan');
    Route::view('/pic/safetyridingtemuan', 'PIC.safetyridingtemuan')->name('pic.safetyridingtemuan');
});
=======
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
>>>>>>> 69a271d9406e6beb69c0fe039ce7d59f6d4dbea3

// // SHE - Insiden Form (no controller)
// Route::get('/she/insiden/form', function () {
//     return view('SHE.insiden_form');
// })->name('she.insiden.form');

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| NO PERMISSION PAGE
|--------------------------------------------------------------------------
*/
Route::get('/no-permission', function() {
    return "Anda belum memiliki menu yang bisa diakses. Hubungi admin.";
})->name('no.permission');
Route::get('/logout', function () {
    return abort(403, 'TINDAKAN ANDA ILEGAL');
});
=======
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
>>>>>>> 69a271d9406e6beb69c0fe039ce7d59f6d4dbea3
