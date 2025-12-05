{{-- include header + sidebar --}}
@include('layout.header')
@extends('layout.sidebar')

@section('content')
<style>
    /* ANIMASI GLOBAL */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeSlide {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .content-wrapper {
        position: relative;
        padding: 24px;
        margin-left: var(--sidebar-width, 260px);
        margin-top: var(--header-height, 64px);
        animation: fadeIn 0.5s ease;
    }

    @media (max-width: 991.98px) {
        .content-wrapper { margin-left: 0; }
    }

    /* TITLES */
    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
        animation: fadeSlide 0.6s ease;
    }

    .page-sub {
        color: #64748b;
        margin-bottom: 24px;
        animation: fadeSlide 0.7s ease;
    }

    /* TOOLS */
    .tools {
        display: flex;
        gap: 14px;
        align-items: center;
        margin-bottom: 20px;
        animation: fadeIn 0.7s ease;
    }

    .tool-input {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 260px;
        transition: all 0.25s ease;
    }
    .tool-input:hover {
        border-color: #3b82f6;
        box-shadow: 0 4px 10px rgba(59,130,246,0.15);
        transform: translateY(-2px);
    }
    .tool-input input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 14px;
    }

    /* BUTTON */
    .btn-primary-aicc {
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 600;
        transition: 0.25s ease;
        box-shadow: 0 3px 6px rgba(59,130,246,0.3);
    }
    .btn-primary-aicc:hover {
        background: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(59,130,246,0.35);
    }

    /* TABLE */
    table.insiden-table {
        width: 100%;
        background: white;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        animation: fadeIn 0.9s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    table.insiden-table thead { background: #f8fafc; }

    table.insiden-table th,
    table.insiden-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
    }

    table.insiden-table tbody tr {
        transition: 0.25s ease;
    }

    table.insiden-table tbody tr:hover {
        background: #f1f5f9;
        transform: scale(1.005);
    }

    /* ACTION BUTTONS */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        transition: 0.25s ease;
    }

    .action-view {
        background: #e0f2fe;
        color: #0369a1;
    }
    .action-view:hover {
        background: #bae6fd;
        transform: translateY(-2px);
    }

    .action-edit {
        background: #fef3c7;
        color: #b45309;
    }
    .action-edit:hover {
        background: #fde68a;
        transform: translateY(-2px);
    }
</style>


<div class="content-wrapper">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <div class="page-title">Data Laporan Insiden</div>
            <div class="page-sub">Summary of reports Insiden</div>
        </div>
        <button class="btn-primary-aicc">Tambah Insiden</button>
    </div>

    <div class="tools">
                <div class="tool-input" id="filterMonth">
                <i class="bi bi-funnel"></i>
                <input type="month" id="monthInput">
            </div>

        <div class="tool-input" style="min-width:320px;">
            <i class="bi bi-search"></i>
            <input type="text" id="searchSection" placeholder="Search By Section">

        </div>
    </div>

    <table class="insiden-table">
        <thead>
            <tr>
                <th style="width:60px;">Id</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Lokasi</th>
                <th>Divisi</th>
                <th style="width:120px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>14/11/25</td>
                <td>14:20</td>
                <td>Casting</td>
                <td>Molting</td>
                <td>
                    <a href="#" class="action-btn action-view"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn action-edit"><i class="bi bi-pencil"></i></a>
                </td>
            </tr>
            <tr>
                <td>02</td>
                <td>16/11/25</td>
                <td>15:20</td>
                <td>Office</td>
                <td>IT</td>
                <td>
                    <a href="#" class="action-btn action-view"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn action-edit"><i class="bi bi-pencil"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    const searchSectionInput = document.getElementById('searchSection');
    const monthInput = document.getElementById('monthInput');
    const tableBody = document.querySelector('.insiden-table tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    function applyFilters() {
        const sectionSearch = searchSectionInput.value.toLowerCase();
        const selectedMonth = monthInput.value; // format: yyyy-mm

        rows.forEach(row => {
            const [id, dateText, timeText, sectionText] = Array.from(row.children).map(td => td.textContent.trim());
            const sectionLower = sectionText.toLowerCase();

            // Filter Section
            const matchSection = sectionSearch ? sectionLower.includes(sectionSearch) : true;

            // Filter Month
            let matchMonth = true;
            if (selectedMonth) {
                const [year, month] = selectedMonth.split("-");
                const [dd, mm, yy] = dateText.split("/");
                const fullYear = "20" + yy; // 25 → 2025
                matchMonth = (fullYear === year && mm === month);
            }

            // Tampilkan atau sembunyikan row
            row.style.display = (matchSection && matchMonth) ? "" : "none";
        });
    }

    searchSectionInput.addEventListener("input", applyFilters);
    monthInput.addEventListener("change", applyFilters);

    // NAVIGATE: Tambah Insiden -> Form page
    const tambahButton = document.querySelector('.content-wrapper .btn-primary-aicc');
    if (tambahButton) {
        tambahButton.addEventListener('click', () => {
            window.location.href = "{{ route('she.insiden.form') }}";
        });
    }
</script>


@endsection

</body>
