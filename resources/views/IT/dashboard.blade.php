@extends('layout.itsidebar')

@section('content')

<style>
    .content {
        margin-left: 10px;               /* lebih dekat ke sidebar */
        padding: 1.5rem 1rem;            /* tidak terlalu jauh dari kiri */
        background: #f1f5f9;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .stat-card {
        border-radius: 14px;
        padding: 1.5rem;
        text-align: center;
        height: 120px;                   /* tinggi lebih proporsional */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-label {
        font-weight: 600;
        color: #64748b;
        font-size: 0.95rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-top: .2rem;
    }
</style>

<div class="content">

    <h2 class="fw-bold mb-1" style="color:#0f172a;">User Overview</h2>
    <p class="text-muted mb-4">Summary of user statistics</p>

    <div class="row g-3">

        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 stat-card">
                <div class="stat-label">Total Users</div>
                <div class="stat-value text-primary">25</div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 stat-card">
                <div class="stat-label">Active Users</div>
                <div class="stat-value text-success">18</div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 stat-card">
                <div class="stat-label">Inactive Users</div>
                <div class="stat-value text-danger">7</div>
            </div>
        </div>

    </div>

</div>

@endsection
