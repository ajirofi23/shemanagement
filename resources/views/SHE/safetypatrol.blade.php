@extends('layout.sidebar')

@section('content')
    <!-- {{-- Blade section: @section('content') --}} -->
    @include('layout.header')

    <!-- Added wrapper to offset content from the sidebar -->
    <div class="sp-content">
        <div class="sp-wrapper">
            <div class="sp-header">
                <div>
                    <h2 class="sp-title">Data Laporan Safety Patrol</h2>
                    <p class="sp-subtitle">Summary of reports Safety Patrol</p>
                </div>

                <div class="sp-actions">
                    <div class="sp-search">
                        <i class="bi bi-search"></i>
                        <input type="text" class="sp-search-input" placeholder="Search reports">
                    </div>
                    <button class="btn btn-primary sp-add-btn">Tambah Laporan</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle sp-table">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama</th>
                            <th>Seksi</th>
                            <th>Temuan Patrol</th>
                            <th style="width:100px;">Bukti</th>
                            <th style="width:100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aji</td>
                            <td>PPC</td>
                            <td>Ban</td>
                            <td><a href="#" class="sp-link">View</a></td>
                            <td><button class="btn btn-danger btn-sm">Open</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Nabil</td>
                            <td>Core JSH</td>
                            <td>SIM Mati</td>
                            <td><a href="#" class="sp-link">View</a></td>
                            <td><button class="btn btn-danger btn-sm">Open</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Tania</td>
                            <td>Core ACE</td>
                            <td>Klakson</td>
                            <td><a href="#" class="sp-link">View</a></td>
                            <td><button class="btn btn-danger btn-sm">Open</button></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Titin</td>
                            <td>QC</td>
                            <td>Speedometer</td>
                            <td><a href="#" class="sp-link">View</a></td>
                            <td><button class="btn btn-success btn-sm">Close</button></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Dimas</td>
                            <td>PROD</td>
                            <td>Plat Nomor</td>
                            <td><a href="#" class="sp-link">View</a></td>
                            <td><button class="btn btn-success btn-sm">Close</button></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Adam</td>
                            <td>PURCH EXIM</td>
                            <td>Pajak STNK Mati</td>
                            <td><a href="#" class="sp-link">View</a></td>
                            <td><button class="btn btn-success btn-sm">Close</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
    /* ==== GLOBAL ANIMATION ==== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* ==== CONTENT OFFSET ==== */
    .sp-content {
        margin-left: 260px;
        padding: 20px;
        animation: fadeIn 0.6s ease;
        /* ADDED: beri jarak dari header agar konten turun */
        margin-top: 100px; /* sesuaikan jika header lebih tinggi/rendah */
    }

    @media (max-width: 992px) {
        .sp-content { 
            margin-left: 0; 
            /* ADDED: ekstra jarak di layar kecil */
            margin-top: 92px; 
        }
    }

    /* ==== WRAPPER ==== */
    .sp-wrapper {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        animation: fadeInUp .6s ease;
    }

    /* ==== HEADER SECTION ==== */
    .sp-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        margin-bottom: 24px;
    }

    .sp-title {
        margin: 0;
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: .3px;
    }

    .sp-subtitle {
        margin-top: 4px;
        color: #64748b;
        font-size: .97rem;
    }

    /* ==== SEARCH + BUTTON ==== */
    .sp-actions {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .sp-search {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 14px;
        border-radius: 12px;
        transition: .25s ease;
    }
    .sp-search:hover {
        background: #eef2f7;
        border-color: #cbd5e1;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.18);
    }

    .sp-search-input {
        border: none;
        outline: none;
        background: transparent;
        width: 230px;
        font-size: .95rem;
        color: #334155;
    }

    .sp-add-btn {
        font-weight: 600;
        border-radius: 12px;
        padding: 8px 16px;
        box-shadow: 0 4px 12px rgba(59, 130, 246, .25);
        transition: .25s ease;
    }
    .sp-add-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, .35);
    }

    /* ==== TABLE ==== */
    .sp-table {
        border-radius: 16px;
        overflow: hidden;
        animation: fadeInUp .6s ease;
    }

    .sp-table thead th {
        font-weight: 700;
        color: #334155;
        background: #f1f5f9 !important;
        letter-spacing: 0.3px;
        border-bottom-width: 2px;
    }

    .sp-table tbody tr {
        transition: .25s ease;
    }

    .sp-table tbody tr:hover {
        background: #f9fafb;
        transform: scale(1.002);
        box-shadow: 0 4px 16px rgba(0, 0, 0, .05);
    }

    /* ==== LINKS ==== */
    .sp-link {
        text-decoration: none;
        color: #2563eb;
        font-weight: 600;
        transition: .2s ease;
    }
    .sp-link:hover {
        text-decoration: underline;
        color: #1d4ed8;
    }

    /* ==== ACTION BUTTONS (OPEN/CLOSE) ==== */
    .btn-sm {
        border-radius: 10px;
        padding: 6px 12px;
        font-weight: 600;
        transition: .25s ease;
    }
    .btn-sm:hover {
        transform: translateY(-3px);
        filter: brightness(1.1);
    }
</style>

@endsection