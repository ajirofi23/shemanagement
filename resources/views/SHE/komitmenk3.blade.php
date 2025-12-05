@extends('layout.sidebar')

@section('content')
    @include('layout.header')

    <!-- @extends('layout.sidebar')

@section('content')
    @include('layout.header') -->

    <style>
    /* ====== TYPOGRAPHY ====== */
    .k3-title {
        color:#0f172a;
        font-weight:800;
        letter-spacing: 0.4px;
        font-size: 1.55rem;
        animation: fadeDown .6s ease;
    }
    .k3-subtitle {
        color:#6b7280;
        font-size: 0.95rem;
        animation: fadeDown .8s ease;
    }

    /* ====== BADGE ====== */
    .badge-target {
        background:#e0edff;
        color:#1e40af;
        padding:6px 12px;
        border-radius: 10px;
        font-weight:600;
        font-size: 0.85rem;
        box-shadow: 0 2px 5px rgba(30,64,175,0.15);
        transition: .3s;
    }
    .badge-target:hover {
        transform: translateY(-2px);
    }

    .text-actual-low {
        font-weight:700;
        animation: fadeUp .7s ease;
    }

    /* ====== CARD ====== */
    .card-k3 {
        border-radius: 22px;
        background: #ffffffd9;
        backdrop-filter: blur(8px);
        border: 1px solid #e9e9ef;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: .3s ease-in-out;
        animation: fadeIn .7s ease;
    }
    .card-k3:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transform: translateY(-3px);
    }

    /* ====== SEARCH INPUT ====== */
    .input-group-text {
        background: #eef2f7;
        border: 1px solid #dce2ea;
        border-radius: 10px 0 0 10px;
    }
    .form-control {
        border-radius: 0 10px 10px 0;
        border: 1px solid #dce2ea;
        transition: .3s;
    }
    .form-control:focus {
        border-color:#4f46e5;
        box-shadow: 0 0 0 2px rgba(79,70,229,0.25);
    }

    /* ====== TABLE ROW ANIMATION ====== */
    table tbody tr {
        transition: .25s;
        animation: fadeUp .6s ease;
    }
    table tbody tr:hover {
        background: #f0f4ff !important;
        transform: translateX(6px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    /* ====== DETAILS ICON POSITION ====== */
 /* ====== DETAILS ICON POSITION (UPDATED) ====== */
        .table td:last-child {
            text-align: center !important;
            vertical-align: middle !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* NEW: center the "Details" header to align with the view icon buttons */
        .table thead th:last-child {
            text-align: center !important;
            vertical-align: middle !important;
        }

        .table td:last-child button {
            transition: .25s;
            border-radius: 10px;
            padding: 6px 10px; /* ukuran tombol konsisten */
        }

    .table td:last-child button:hover {
        background:#4f46e5;
        color:white;
        transform: scale(1.15);
        box-shadow: 0 4px 10px rgba(79,70,229,0.4);
    }

    /* ====== SIDEBAR FIX ====== */
    .content-with-sidebar {
        margin-left: 280px;
        display: flex;
        justify-content: center;
        padding-top: 8vh;
        animation: fadeIn .5s ease;
    }
    @media (max-width: 992px) {
        .content-with-sidebar { margin-left: 0; }
    }

    /* ====== ANIMATIONS ====== */
    @keyframes fadeIn {
        from { opacity:0; transform: translateY(10px); }
        to   { opacity:1; transform: translateY(0); }
    }
    @keyframes fadeUp {
        from { opacity:0; transform: translateY(16px); }
        to   { opacity:1; transform: translateY(0); }
    }
    @keyframes fadeDown {
        from { opacity:0; transform: translateY(-16px); }
        to   { opacity:1; transform: translateY(0); }
    }
    </style>



    {{-- Wrapper untuk sidebar --}}
    <div class="content-with-sidebar">
        <div class="container-fluid" style="margin-top: 16px;">
            <div class="card card-k3 shadow-sm">
                <div class="card-body">
                    <h5 class="k3-title mb-1">Data Laporan Komitmen K3</h5>
                    <p class="k3-subtitle mb-3">Summary of reports Komitmen K3</p>

                    <div class="d-flex flex-wrap gap-3 mb-3">
                        <div class="input-group" style="max-width:320px;">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search By Section">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Section</th>
                                    <th>Target</th>
                                    <th>Actual</th>
                                    <th>Jumlah</th>
                                    <th>Details</th> <!-- now centered via CSS -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ENG</td>
                                    <td><span class="badge badge-target">100%</span></td>
                                    <td class="text-actual-low">60%</td>
                                    <td>40</td>
                                    <td>
                                        <!-- changed: make only this "view" icon navigate to the section detail page -->
                                        <a href="{{ url('/she/section') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Core JSH</td>
                                    <td><span class="badge badge-target">100%</span></td>
                                    <td class="text-actual-low" style="color:#f97316;">80%</td>
                                    <td>20</td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>PPC</td>
                                    <td><span class="badge badge-target">100%</span></td>
                                    <td class="text-actual-low" style="color:#22c55e;">90%</td>
                                    <td>20</td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Molding ACE</td>
                                    <td><span class="badge badge-target">100%</span></td>
                                    <td class="text-actual-low">50%</td>
                                    <td>50</td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelector('input[placeholder="Search By Section"]').addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            let section = row.children[1].innerText.toLowerCase();
            row.style.display = section.includes(value) ? "" : "none";
        });
    });

document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("table tbody tr");

    rows.forEach(row => {
        let actualCell = row.children[3]; // kolom Actual
        if (!actualCell) return;

        let text = actualCell.innerText.replace("%", "").trim();
        let value = parseInt(text);

        // Reset styling dulu
        actualCell.style.fontWeight = "700";

        // Terapkan warna berdasarkan nilai
        if (value === 100) {
            actualCell.style.color = "#22c55e"; // hijau
        } else if (value >= 80) {
            actualCell.style.color = "#facc15"; // kuning
        } else if (value >= 50) {
            actualCell.style.color = "#f97316"; // oranye kemerahan
        } else if (value > 0) {
            actualCell.style.color = "#ef4444"; // merah
        } else {
            actualCell.style.color = "#b91c1c"; // merah tua (0%)
        }
    });
});

    </script>

@endsection
