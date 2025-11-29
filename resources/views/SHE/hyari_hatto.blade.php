@extends('layout.sidebar')
@include('layout.header')
@section('content')

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f3f4f6;
        color: #0f172a;
    }

    /* GLOBAL ANIMATION */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeSlide {
        from { opacity: 0; transform: translateX(-10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* FOLLOW LAYOUT SIDEBAR & HEADER */
    .content-wrapper {
        margin-left: 260px;
        padding: 25px;
        padding-top: 95px;
        animation: fadeUp 0.5s ease-out;
    }

    /* TITLES */
    .page-title {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #0f172a;
        letter-spacing: -0.4px;
        animation: fadeSlide 0.6s ease-out;
    }

    .page-subtitle {
        font-size: 15px;
        color: #6b7280;
        margin-bottom: 24px;
        animation: fadeSlide 0.7s ease-out;
    }

    /* SEARCH + FILTER WRAPPER */
    .search-filter-wrap {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 24px;
        background: #ffffffcc;
        backdrop-filter: blur(6px);
        padding: 18px;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        transition: 0.3s ease;
    }
    .search-filter-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    /* SEARCH BOX */
    .search-wrap {
        max-width: 360px;
        position: relative;
        flex: 1;
        min-width: 240px;
        animation: fadeUp 0.8s ease-out;
    }
    .search-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 18px;
    }

    .search-input {
        width: 100%;
        padding: 12px 12px 12px 44px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #ffffff;
        font-size: 14px;
        color: #111827;
        transition: 0.25s ease;
    }
    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 8px rgba(59,130,246,0.25);
    }

    /* FILTER DROPDOWN */
    .filter-section {
        position: relative;
        min-width: 180px;
        animation: fadeUp 0.9s ease-out;
    }

    .filter-select {
        width: 100%;
        padding: 12px 36px 12px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #ffffff;
        transition: 0.25s ease;
    }
    .filter-select:hover {
        border-color: #3b82f6;
    }

    /* CARD WRAPPER */
    .card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        animation: fadeUp 1s ease-out;
        transition: 0.3s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.07);
    }

    /* TABLE */
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14.5px;
    }

    .table th {
        padding: 16px 14px;
        background: #f8fafc;
        color: #1e293b;
        border-bottom: 1px solid #e2e8f0;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .table td {
        padding: 16px 14px;
        color: #0f172a;
        border-bottom: 1px solid #f1f5f9;
        transition: 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f1f5f9;
        transform: scale(1.005);
        transition: 0.2s ease-in-out;
    }

    /* LINK VIEW */
    .link-view {
        color: #2563eb;
        font-weight: 500;
        transition: 0.2s ease;
    }
    .link-view:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    /* ANIMATION CLASS */
    .fade-up {
        opacity: 0;
        transform: translateY(24px);
        transition: 0.6s ease;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>


<main class="content-wrapper">

    <div class="page-title fade-up">Data Laporan Hyari Hatto</div>
    <div class="page-subtitle fade-up">Summary of reports Hyari Hatto</div>

    <div class="search-filter-wrap fade-up">
        <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input class="search-input" type="text" id="searchInput" placeholder="Search reports...">
        </div>

        <div class="filter-section">
            <select class="filter-select" id="filterSection">
                <option value="">All Sections</option>
                <option value="Production">Production</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Warehouse">Warehouse</option>
                <option value="Office">Office</option>
            </select>
        </div>
    </div>

    <div class="card fade-up">
        <div class="table-responsive">
            <table class="table" id="reportTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Section</th>
                        <th>Kondisi Temuan</th>
                        <th>Potensi Bahaya</th>
                        <th>Deskripsi</th>
                        <th>Bukti</th>
                        <th>Usulan</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>1</td>
                        <td>Production</td>
                        <td>1. Tidak Menggunakan APD</td>
                        <td>1. Mata terkena Gas</td>
                        <td>Karyawan tidak menggunakan APD</td>
                        <td><a href="#" class="link-view">View <i class="bi bi-eye"></i></a></td>
                        <td>Dilakukan pembinaan dan ditegur</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal bukti --}}
    <div class="modal fade" id="proofModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="proofImage" src="{{ asset('images/hiyari-hatto-form.jpg') }}" class="img-fluid rounded">
                </div>
                <div class="modal-footer">
                    <button id="downloadPdfBtn" class="btn btn-primary">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

</main>

{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const observer = new IntersectionObserver((entries)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
            }
        });
    });
    document.querySelectorAll('.fade-up').forEach(el=>observer.observe(el));
</script>

<script>
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSection');
    const tableBody = document.getElementById('tableBody');
    const originalRows = Array.from(tableBody.querySelectorAll('tr'));

    function applyFilters(){
        const search = searchInput.value.toLowerCase();
        const section = filterSelect.value;

        tableBody.innerHTML = '';

        const filtered = originalRows.filter(row=>{
            const sec = row.children[1].textContent.trim();
            const text = row.textContent.toLowerCase();

            const okSearch = search === '' || text.includes(search);
            const okSection = section === '' || sec === section;

            return okSearch && okSection;
        });

        if(filtered.length === 0){
            tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:#999">No matching reports found</td></tr>`;
        } else {
            filtered.forEach(row=>tableBody.appendChild(row));
        }
    }

    searchInput.addEventListener('input', applyFilters);
    filterSelect.addEventListener('change', applyFilters);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    const modal = new bootstrap.Modal(document.getElementById('proofModal'));
    document.querySelectorAll('.link-view').forEach(a=>{
        a.addEventListener('click', e=>{
            e.preventDefault();
            modal.show();
        });
    });

    const downloadBtn = document.getElementById('downloadPdfBtn');
    const proofImage = document.getElementById('proofImage');

    downloadBtn.addEventListener('click', async ()=>{
        const { jsPDF } = window.jspdf;

        const img = new Image();
        img.src = proofImage.src;
        await img.decode();

        const canvas = document.createElement('canvas');
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        canvas.getContext('2d').drawImage(img, 0, 0);

        const imgData = canvas.toDataURL('image/jpeg', 1.0);

        const pdf = new jsPDF({
            orientation: img.width > img.height ? 'landscape' : 'portrait',
            unit: 'pt',
            format: 'a4'
        });

        const pageW = pdf.internal.pageSize.width;
        const pageH = pdf.internal.pageSize.height;

        const ratio = Math.min(pageW / img.width, pageH / img.height);

        pdf.addImage(
            imgData,
            'JPEG',
            (pageW - img.width*ratio)/2,
            (pageH - img.height*ratio)/2,
            img.width*ratio,
            img.height*ratio
        );

        pdf.save('bukti-laporan-hiyari-hatto.pdf');
    });
</script>

@endsection
