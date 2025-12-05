@extends('layout.picsidebar')
@extends('layout.header') 

@section('content')

<div class="content" style="padding: 2rem;">
    <h2 class="mb-2" style="color:#0f172a; font-weight: 800;">Data Laporan Safety Patrol</h2>
    <p class="mb-4 text-muted">Summary of reports Safety Patrol</p>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        
        <div class="d-flex flex-wrap gap-2">
            
            <div class="input-group" style="max-width: 200px;">
                <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                <input type="month" class="form-control" placeholder="Filter by Month/Year" aria-label="Filter Month/Year">
            </div>

            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search By Kondisi/Bahaya..." aria-label="Search">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <a href="#" class="btn btn-success" style="background-color: #28a745; border-color: #28a745; font-weight: 600;">
            <i class="bi bi-file-earmark-excel me-2"></i> Export To Excel
        </a>

        <a href="#" class="btn btn-primary" style="font-weight: 600;">
            <i class="bi bi-plus-lg me-2"></i> Tambah Data
        </a>
        
    </div>
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
            <div class="table-responsive custom-table-wrapper">
                <table class="table table-striped table-hover mt-3 align-middle">

                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Area</th>
                            <th scope="col">Problem</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Details</th> 
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2025-11-28</td> 
                            <td>Produksi A</td> 
                            <td><span class="badge bg-warning text-dark">Lantai Basah</span></td>
                            <td>2025-12-05</td> 
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View Detail"><i class="bi bi-eye"></i></a>
                            </td>
                            {{-- Status: Open (Merah) --}}
                            <td><span class="badge bg-danger">Open</span></td> 
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a> 
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>2025-11-27</td>
                            <td>Gudang 3</td>
                            <td><span class="badge bg-danger">Kabel Terkelupas</span></td>
                            <td>2025-11-28</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View Detail"><i class="bi bi-eye"></i></a>
                            </td>
                            {{-- Status: Close (Hijau) --}}
                            <td><span class="badge bg-success">Close</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a> 
                            </td>
                        </tr>
                        
                        <tr>
                            <td>3</td>
                            <td>2025-11-26</td>
                            <td>Area Rak B</td>
                            <td><span class="badge bg-success">Penyimpanan Tinggi</span></td>
                            <td>2025-12-15</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info text-white" title="View Detail"><i class="bi bi-eye"></i></a>
                            </td>
                            {{-- Status: Open (Merah) --}}
                            <td><span class="badge bg-danger">Open</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
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
        overflow: hidden;
        text-overflow: ellipsis;
    }
    /* Set lebar minimum pada kolom-kolom deskriptif agar terbaca */
    .table td:nth-child(4) { /* Kolom Problem */
         white-space: normal; 
         max-width: 150px;
    }
</style>

@endsection