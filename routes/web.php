<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingMaterialsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IT\DashboardController;
use App\Http\Controllers\IT\UserController;
use App\Http\Controllers\SHE\MasterPtaController;
use App\Http\Controllers\SHE\MasterKtaController;
use App\Http\Controllers\SHE\MasterPbController;
use App\Http\Controllers\PIC\HyariController;
use App\Http\Controllers\PIC\PicDashboardController;
Use App\Http\Controllers\PIC\PicHyariController;


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

    Route::prefix('she')->middleware('permission')->group(function () {
        Route::get('/she/master/pta', [MasterPtaController::class, 'index']);
    });

    Route::prefix('she')->middleware('permission')->group(function () {
        Route::get('/she/master/kta', [MasterPtaController::class, 'index']);
    });

    Route::prefix('she')->middleware('permission')->group(function () {
        Route::get('/she/master/pb', [MasterPbController::class, 'index']);
    });


    Route::prefix('pic')->middleware('permission')->group(function () {
        Route::get('/dashboard', [PicDashboardController::class, 'index']);
       
    });


    Route::get('/management-user', [UserController::class, 'index']);
    Route::post('it/management-user/store', [UserController::class, 'store']);
    Route::get('/it/management-user/edit/{id}', [UserController::class, 'edit']);
    Route::put('/it/management-user/update/{id}', [UserController::class, 'update']);
    Route::delete('it/management-user/destroy/{id}', [UserController::class, 'destroy']);

    
    Route::get('/she/master/pta', [MasterPtaController::class, 'index']);
    Route::post('/she/master/pta/store', [MasterPtaController::class, 'store']);
    Route::get('/she/master/pta/edit/{id}', [MasterPtaController::class, 'edit']);
    Route::put('/she/master/pta/update/{id}', [MasterPtaController::class, 'update']);
    Route::delete('/she/master/pta/destroy/{id}', [MasterPtaController::class, 'destroy']);
   
    Route::get('/she/master/kta', [MasterKtaController::class, 'index']);
    Route::post('/she/master/kta/store', [MasterKtaController::class, 'store']);
    Route::get('/she/master/kta/edit/{id}', [MasterKtaController::class, 'edit']);
    Route::put('/she/master/kta/update/{id}', [MasterKtaController::class, 'update']);
    Route::delete('/she/master/kta/destroy/{id}', [MasterKtaController::class, 'destroy']);

    Route::get('/she/master/pb', [MasterPbController::class, 'index']);
    Route::post('/she/master/pb/store', [MasterPbController::class, 'store']);
    Route::get('/she/master/pb/edit/{id}', [MasterPbController::class, 'edit']);
    Route::put('/she/master/pb/update/{id}', [MasterPbController::class, 'update']);
    Route::delete('/she/master/pb/destroy/{id}', [MasterPbController::class, 'destroy']);
   
    Route::get('/pic/laporanhyarihatto', [PicHyariController::class, 'index']);
    Route::post('/pic/laporanhyarihatto/store', [PicHyariController::class, 'store']);
    Route::get('/pic/laporanhyarihatto/edit/{id}', [PicHyariController::class, 'edit']);
    Route::put('/pic/laporanhyarihatto/update/{id}', [PicHyariController::class, 'update']);
    Route::delete('/pic/laporanhyarihatto/destroy/{id}', [PicHyariController::class, 'destroy']);
});

   
//     /*
//     |--------------------------------------------------------------------------
//     | ROUTES SHE (Login Only, No Permission)
//     |--------------------------------------------------------------------------
//     */
//     Route::view('/she/dashboard', 'SHE.dashboard')->name('she.dashboard');

//     Route::get('/she-policies', function () {
//         return view('she-policies');
//     })->name('she.policies');

//     Route::get('/training-materials', [TrainingMaterialsController::class, 'index'])
//         ->name('training.materials');

//     // Hyari Hatto
//     Route::get('/she/hyari-hatto', function () {
//         return view('she.hyari_hatto');
//     })->name('she.hyarihatto');

//     // Insiden
//     Route::get('/she/insiden', function () {
//         return view('SHE.insiden');
//     })->name('she.insiden');

//     Route::get('/she/insiden/form', function () {
//         return view('SHE.insiden_form');
//     })->name('she.insiden.form');

//     Route::post('/she/insiden', function (\Illuminate\Http\Request $request) {
//         $request->validate([
//             'tanggal' => 'required|date',
//             'jam' => 'required',
//             'lokasi' => 'required|string|max:150',
//             'kategori' => 'required|string',
//             'departemen' => 'required|string',
//             'kronologi' => 'required|string|max:3000',
//         ]);
//         return redirect()->route('she.insiden')
//             ->with('status', 'Laporan berhasil dikirim!');
//     })->name('she.insiden.store');

//     // Komitmen K3
//     Route::view('/she/komitmen-k3', 'SHE.komitmenk3')->name('she.komitmenk3');

//     // Section
//     Route::get('/she/section/{section?}', function ($section = 'ENG') {
//         return view('SHE.section', ['section' => $section]);
//     })->name('she.section');

//     Route::get('/komitmen-k3/section/{section}', function ($section) {
//         return view('SHE.section', ['section' => $section]);
//     })->name('she.section');

//     // Safety pages
//     Route::get('/she/safety-riding', function () {
//         return view('SHE.safetyriding');
//     })->name('she.safetyriding');

//     Route::get('/she/safety-patrol', function () {
//         return view('SHE.safetypatrol');
//     })->name('she.safetypatrol');


//     /*
//     |--------------------------------------------------------------------------
//     | PIC ROUTES
//     |--------------------------------------------------------------------------
//     */
//     Route::view('/pic/dashboard', 'PIC.dashboard')->name('pic.dashboard');
//     Route::view('/pic/laporanhyarihatto', 'PIC.laporanhyarihatto')->name('pic.laporanhyarihatto');
//     Route::view('/pic/komitmenk3', 'PIC.komitmenk3')->name('pic.komitmenk3');
//     Route::view('/pic/safetypatroltemuan', 'PIC.safetypatroltemuan')->name('pic.safetypatroltemuan');
//     Route::view('/pic/safetyridingtemuan', 'PIC.safetyridingtemuan')->name('pic.safetyridingtemuan');
// });


// /*
// |--------------------------------------------------------------------------
// | NO PERMISSION PAGE
// |--------------------------------------------------------------------------
// */
// Route::get('/no-permission', function() {
//     return "Anda belum memiliki menu yang bisa diakses. Hubungi admin.";
// })->name('no.permission');
// Route::get('/logout', function () {
//     return abort(403, 'TINDAKAN ANDA ILEGAL');
// });
