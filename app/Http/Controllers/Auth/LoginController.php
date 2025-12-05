<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = [
        'usr' => $request->usr,
        'password' => $request->pswd
    ];

    if (Auth::attempt($credentials)) {

        // Ambil semua permission user
        $permissions = DB::table('tb_user_permissions')
            ->where('user_id', Auth::user()->id)
            ->get();

        session(['user_permissions' => $permissions]);

        // 🔥 Cari menu pertama yang user punya akses
        $firstMenu = DB::table('tb_user_permissions as up')
            ->join('tb_menus as m', 'm.id', '=', 'up.menu_id')
            ->where('up.user_id', Auth::user()->id)
            ->where('up.can_access', 1)
            ->orderBy('m.urutan_menu', 'ASC')
            ->select('m.url')
            ->first();

        // Jika ada menu yang boleh diakses → redirect ke sana
        if ($firstMenu) {
            return redirect($firstMenu->url);
        }

        // Jika tidak punya menu sama sekali
        return redirect()->route('no.permission');
    }

    return back()->with('error', 'Username atau password salah');
}


   public function logout(Request $request)
{
    // Hapus session Auth
    Auth::logout();

    // Hapus semua session lain
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect ke login
    return redirect('/login');
}

}
