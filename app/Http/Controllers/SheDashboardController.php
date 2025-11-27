<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\SafetyStat;

class SheDashboardController extends Controller
{
    public function __construct()
    {
        // pastikan user login
        $this->middleware('auth:web'); // Specify guard explicitly if default is not set
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Batasi hanya untuk role SHE
        if (!$user || strtoupper($user->role ?? '') !== 'SHE') {
            abort(403, 'Only SHE users can access this page');
        }

        // Hitung agregasi insiden berdasarkan kategori
        $counts = [
            'work_accident_loss_day'     => Incident::where('type', 'work_accident_loss_day')->count(),
            'work_accident_light'        => Incident::where('type', 'work_accident_light')->count(),
            'traffic_accident'           => Incident::where('type', 'traffic_accident')->count(),
            'fire_accident'              => Incident::where('type', 'fire_accident')->count(),
            'forklift_accident'          => Incident::where('type', 'forklift_accident')->count(),
            'molten_spill_incident'      => Incident::where('type', 'molten_spill_incident')->count(),
            'property_damage_incident'   => Incident::where('type', 'property_damage_incident')->count(),
        ];

        // Ambil Total Safety Work Day (rekaman terbaru)
        $totalSafetyWorkDays = SafetyStat::query()
            ->latest('recorded_at')
            ->value('total_safety_work_days') ?? 0;

        return view('she.dashboard', [
            'counts' => $counts,
            'totalSafetyWorkDays' => $totalSafetyWorkDays,
            'user' => $user,
        ]);
    }
}