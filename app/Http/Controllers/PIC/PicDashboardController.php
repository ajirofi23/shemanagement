<?php

namespace App\Http\Controllers\PIC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PicDashboardController extends Controller
{
    public function index()
    {
        return view('PIC.dashboard');
    }
}
