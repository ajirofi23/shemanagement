<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('admin.user_dashboard', [
            'totalUsers'   => User::count(),
            'activeUsers'  => User::where('is_active', 1)->count(),
            'inactiveUsers'=> User::where('is_active', 0)->count(),
            'totalRoles'   => Role::count(),
            'latestUsers'  => User::latest()->take(5)->get(),
        ]);
    }
}
