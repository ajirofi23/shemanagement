@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">DASHBOARD MONITORING</h4>
        <div class="fw-bold">{{ strtoupper($user->name ?? 'SHE USER') }}</div>
    </div>
    <p class="text-muted mb-4">Summary of safety performance AICC</p>

    <div class="card mb-4">
        <div class="card-header fw-bold">Total Safety Work Day</div>
        <div class="card-body">
            <div class="display-4">{{ $totalSafetyWorkDays }}</div>
        </div>
    </div>

    @php
        $boxes = [
            'Work Accident (Loss day)' => $counts['work_accident_loss_day'] ?? 0,
            'Work Accident (Light)'    => $counts['work_accident_light'] ?? 0,
            'Traffic Accident'         => $counts['traffic_accident'] ?? 0,
            'Fire Accident'            => $counts['fire_accident'] ?? 0,
            'Forklift Accident'        => $counts['forklift_accident'] ?? 0,
            'Molten spill Insident'    => $counts['molten_spill_incident'] ?? 0,
            'Property Damage Insident' => $counts['property_damage_incident'] ?? 0,
        ];
    @endphp

    <div class="row g-3">
        @foreach($boxes as $title => $value)
            <div class="col-12 col-md-4">
                <div class="card h-100">
                    <div class="card-header fw-bold">{{ $title }}</div>
                    <div class="card-body">
                        <div class="display-6">{{ $value }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection