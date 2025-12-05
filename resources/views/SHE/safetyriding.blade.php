@extends('layout.sidebar')

@section('content')
    @include('layout.header')

    <div class="sr-content">
   

<h2 class="sr-title">Dashboard Safety Riding</h2>  <!-- Judul baru -->



                    <div class="sr-toolbar">
                    <button class="btn-filter" id="filterSectionBtn">
                <i class="bi bi-funnel"></i> Filter By Section
            </button>

            <!-- Dropdown Section -->
            <div class="dropdown-section" id="dropdownSection">
                <div class="dropdown-item" data-section="Parking Area">Parking Area</div>
                <div class="dropdown-item" data-section="Warehouse">Warehouse</div>
                <div class="dropdown-item" data-section="Production">Production</div>
                <div class="dropdown-item" data-section="Office">Office</div>
                <div class="dropdown-item" data-section="ALL">Show All</div>
            </div>

            <button class="btn-filter"><i class="bi bi-funnel"></i> Filter By Departement</button>

            <div class="sr-search">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search reports" />
            </div>

            <button class="btn-add">Tambah Laporan</button>
        </div>

        <div class="sr-table-wrap">
            <table class="sr-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Area</th>
                        <th>Problem</th>
                        <th>Due Date</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>11/10/25</td>
                        <td>Parking Area</td>
                        <td>Helm tidak standar</td>
                        <td>12/10/25</td>
                        <td><a href="#" class="sr-link">View</a></td>
                        <td><span class="badge badge-open">Open</span></td>
                        <td class="sr-actions">
                            <button class="btn-icon danger" title="Reject"><i class="bi bi-x-lg"></i></button>
                            <button class="btn-icon success" title="Approve"><i class="bi bi-check-lg"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

            <style>

        /* ========== GLOBAL ANIMATION ========== */
        @keyframes fadeSlideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeScale {
            from { opacity: 0; transform: scale(.94); }
            to   { opacity: 1; transform: scale(1); }
        }

        /* ========== TITLE ========== */
        .sr-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 20px;
            margin-left: 4px;
            animation: fadeSlideDown 0.6s ease forwards;
        }

        /* ========== PAGE CONTENT ========== */
        .sr-content {
            margin-left: var(--sidebar-width, 260px);
            padding: 16px;
            padding-top: 100px !important;
            animation: fadeScale .7s ease;
        }

        @media (max-width: 768px) {
            .sr-content {
                margin-left: 0;
            }
        }

        /* ========== TOOLBAR ========== */
        .sr-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            flex-wrap: wrap;
            animation: fadeUp .6s ease;
        }

        .btn-filter {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid #d1d5db;
            background: linear-gradient(135deg, #ffffff, #f9fafb);
            border-radius: 10px;
            color: #374151;
            font-weight: 600;
            cursor: pointer;
            transition: .2s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,.05);
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,.12);
        }

        /* Dropdown */
        .dropdown-section {
            position: absolute;
            margin-top: 6px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            width: 220px;
            display: none;
            animation: fadeScale .25s ease;
            z-index: 10;
        }

        .dropdown-item {
            padding: 11px 14px;
            cursor: pointer;
            font-size: 0.95rem;
            color: #374151;
            transition: .2s;
        }

        .dropdown-item:hover {
            background: #eff6ff;
            color: #1d4ed8;
        }

        /* Search */
        .sr-search {
            flex: 1 1 320px;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 10px;
            padding: 10px 14px;
            max-width: 420px;
            margin-left: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,.05);
            transition: .2s ease;
        }

        .sr-search:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 4px 14px rgba(59,130,246,.25);
        }

        .sr-search input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 0.95rem;
        }

        /* Add Button */
        .btn-add {
            padding: 10px 18px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(37,99,235,.35);
            transition: .2s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37,99,235,.45);
        }

        /* ========== TABLE ========== */
        .sr-table-wrap {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.07);
            overflow: hidden;
            animation: fadeUp .7s ease;
        }

        .sr-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sr-table thead th {
            background: #f9fafb;
            color: #374151;
            font-weight: 700;
            text-align: left;
            padding: 14px 18px;
            border-bottom: 1px solid #e5e7eb;
            font-size: .95rem;
        }

        .sr-table tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
            font-size: .92rem;
            vertical-align: middle;
            transition: .25s ease;
        }

        .sr-table tbody tr:hover td {
            background: #f1f5f9;
        }

        /* Link */
        .sr-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 6px 13px;
            border-radius: 999px;
            font-size: 0.83rem;
            font-weight: 700;
        }

        .badge-open {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* Table action icons */
        .sr-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            color: #111827;
            transition: .2s ease;
        }

        .btn-icon:hover {
            transform: scale(1.06);
        }

        .btn-icon.danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-icon.success {
            background: #dcfce7;
            color: #15803d;
        }

        </style>


<script>
document.getElementById("filterSectionBtn").addEventListener("click", function() {
    const dropdown = document.getElementById("dropdownSection");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Klik item dropdown
document.querySelectorAll(".dropdown-item").forEach(item => {
    item.addEventListener("click", function() {
        const selected = this.getAttribute("data-section");

        const rows = document.querySelectorAll(".sr-table tbody tr");

        rows.forEach(row => {
            const area = row.children[2].innerText.trim();

            if (selected === "ALL" || area === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        document.getElementById("dropdownSection").style.display = "none";
    });
});

// Tutup dropdown jika klik di luar
document.addEventListener("click", function(e) {
    const dropdown = document.getElementById("dropdownSection");
    const button = document.getElementById("filterSectionBtn");

    if (!dropdown.contains(e.target) && !button.contains(e.target)) {
        dropdown.style.display = "none";
    }
});
</script>

@endsection