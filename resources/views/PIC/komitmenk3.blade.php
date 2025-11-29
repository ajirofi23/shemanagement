@extends('layout.picsidebar')
@extends('layout.header')

@section('content')

<div class="content" style="padding: 2rem;">
    <h2 class="mb-2" style="color:#0f172a; font-weight: 800;">Data Laporan Komitmen K3</h2>
    <p class="mb-4 text-muted">Summary of reports Komitmen K3</p>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        
        <div class="d-flex flex-wrap gap-2">
            
            <div class="input-group" style="max-width: 200px;">
        <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
        <input type="month" class="form-control" placeholder="Filter by Month/Year" aria-label="Filter Month/Year">
    </div>

            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search By Name/NIP..." aria-label="Search">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <a href="#" class="btn btn-success" style="background-color: #28a745; border-color: #28a745; font-weight: 600;">
            <i class="bi bi-file-earmark-excel me-2"></i> Export To Excel
        </a>
    </div>
    
   <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
            <div class="table-responsive custom-table-wrapper">
                <table class="table table-striped table-hover mt-3 align-middle">

                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Section</th>
                            <th scope="col">Departemen</th>
                            <th scope="col">Status K3</th>
                            <th scope="col">Komitmen K3</th> 
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aji</td>
                            <td>43897</td>
                            <td>ENG</td>
                            <td>Engineering</td>
                            <td><span class="badge bg-danger" style="padding: 0.5em 0.8em;">Belum Upload</span></td>
                            <td class="text-truncate" style="max-width: 150px;">Mengecek peralatan sebelum digunakan</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editK3Modal" data-id="1" data-nama="Aji" data-section="ENG" data-komitmen="Mengecek peralatan sebelum digunakan" data-date="2024-11-20"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Nabil</td>
                            <td>43898</td>
                            <td>ENG</td>
                            <td>Engineering</td>
                            <td><span class="badge bg-success" style="padding: 0.5em 0.8em;">Sudah Upload</span></td>
                            <td class="text-truncate" style="max-width: 150px;">Selalu menggunakan APD saat bekerja</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editK3Modal" data-id="2" data-nama="Nabil" data-section="ENG" data-komitmen="Selalu menggunakan APD saat bekerja" data-date="2024-11-25"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>3</td>
                            <td>Tania</td>
                            <td>43899</td>
                            <td>ENG</td>
                            <td>Engineering</td>
                            <td><span class="badge bg-success" style="padding: 0.5em 0.8em;">Sudah Upload</span></td>
                            <td class="text-truncate" style="max-width: 150px;">Menjaga kebersihan area kerja</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editK3Modal" data-id="3" data-nama="Tania" data-section="ENG" data-komitmen="Menjaga kebersihan area kerja" data-date="2024-11-26"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Titin</td>
                            <td>43900</td>
                            <td>ENG</td>
                            <td>Engineering</td>
                            <td><span class="badge bg-danger" style="padding: 0.5em 0.8em;">Belum Upload</span></td>
                            <td class="text-truncate" style="max-width: 150px;">Mengingatkan rekan kerja tentang safety</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editK3Modal" data-id="4" data-nama="Titin" data-section="ENG" data-komitmen="Mengingatkan rekan kerja tentang safety" data-date="2024-11-01"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Daryana</td>
                            <td>43901</td>
                            <td>ENG</td>
                            <td>Engineering</td>
                            <td><span class="badge bg-danger" style="padding: 0.5em 0.8em;">Belum Upload</span></td>
                            <td class="text-truncate" style="max-width: 150px;">Melakukan inspeksi harian</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editK3Modal" data-id="5" data-nama="Daryana" data-section="ENG" data-komitmen="Melakukan inspeksi harian" data-date="2024-11-01"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>Nafiz</td>
                            <td>43902</td>
                            <td>ENG</td>
                            <td>Engineering</td>
                            <td><span class="badge bg-success" style="padding: 0.5em 0.8em;">Sudah Upload</span></td>
                            <td class="text-truncate" style="max-width: 150px;">Memastikan semua mesin dalam kondisi baik</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-warning edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editK3Modal" data-id="6" data-nama="Nafiz" data-section="ENG" data-komitmen="Memastikan semua mesin dalam kondisi baik" data-date="2024-11-28"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div
            
            {{-- Pagination Placeholder --}}
            <div class="d-flex justify-content-end mt-4">
                <ul class="pagination mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS kustom dipertahankan untuk tampilan tabel yang rapi */
    .custom-table-wrapper {
        overflow-x: auto;
    }
    .table thead th {
        border-bottom: 2px solid #e2e8f0;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 700;
        color: #6b7280;
    }
    .table tbody tr:hover {
        background-color: #f1f5f9;
    }
    .table td {
        white-space: nowrap; 
    }
</style>

@endsection