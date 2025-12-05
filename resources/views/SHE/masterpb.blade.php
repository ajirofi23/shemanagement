@extends('layout.sidebar')

@section('content')

{{-- UBAH p-4 MENJADI p-3 pada div content --}}
<div class="content p-3">

    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Menggunakan H3 agar tidak terlalu besar --}}
        <h3 style="color:#0f172a;" class="fw-bold">
            {{-- ICON disesuaikan dengan Data Master --}}
            {{-- DIUBAH: Perilaku Tidak Aman (PTA) -> Potensi Bahaya (PB) --}}
            <i class="bi bi-database-fill-gear me-2 text-primary"></i> Data Master: Potensi Bahaya (PB)
        </h3>
        
        {{-- Tombol Tambah PB --}}
        {{-- DIUBAH: #addPtaModal -> #addPbModal --}}
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addPbModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Data Baru
        </button>
    </div>
    
    <hr class="mb-4">

    <div class="card shadow-lg border-0">
        {{-- UBAH p-4 MENJADI p-3 pada card-body --}}
        <div class="card-body p-3">
            <h5 class="card-title mb-3 fs-5 text-secondary">
                {{-- DIUBAH: Daftar Perilaku Tidak Aman -> Daftar Potensi Bahaya --}}
                <i class="bi bi-list-columns-reverse me-1"></i> Daftar Potensi Bahaya
            </h5>

            {{-- Search & Export --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Search --}}
                {{-- DIUBAH: rute /pta -> /pb --}}
                <form action="{{ url('/she/master/pb') }}" method="GET" class="d-flex flex-grow-1 me-3">
                    <div class="input-group">
                        {{-- Menggunakan form-control standar --}}
                        <input type="text" id="searchInput" name="search" value="{{ request('search') }}" class="form-control border-primary" style="max-width: 300px;" placeholder="">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>

                {{-- Export (ENDPOINT disesuaikan) --}}
                {{-- DIUBAH: rute /pta -> /pb --}}
                <a href="{{ url('/she/master/pb/export') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export CSV
                </a>
            </div>

            {{-- Tabel PB --}}
            <div class="table-responsive">
                {{-- Mengubah kelas table-sm menjadi standar karena kolom lebih sedikit --}}
                <table class="table table-hover table-striped mt-3 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 50px;">#</th>
                            {{-- DIUBAH: Perilaku Tidak Aman -> Potensi Bahaya --}}
                            <th scope="col">Potensi Bahaya</th>
                            <th scope="col" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- DIUBAH: $ptas -> $pbs --}}
                        @foreach($pbs as $pb)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- DIUBAH: $pta->nama_pta -> $pb->nama_pb --}}
                            <td class="fw-bold">{{ $pb->nama_pb }}</td>
                            <td>
                                {{-- Tombol Edit (data-bs-target disesuaikan) --}}
                                @if(isset($permission) && $permission->can_edit)
                                <button type="button" class="btn btn-sm btn-primary me-1" 
                                    data-bs-toggle="modal" 
                                    {{-- DIUBAH: #editPtaModal -> #editPbModal --}}
                                    data-bs-target="#editPbModal{{ $pb->id }}"
                                    title="Edit Data">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @endif

                                {{-- Tombol Delete (ENDPOINT disesuaikan) --}}
                                @if(isset($permission) && $permission->can_delete)
                                {{-- DIUBAH: rute /pta/destroy/ -> /pb/destroy/ dan variabel $pta->nama_pta -> $pb->nama_pb --}}
                                <form action="{{ url('/she/master/pb/destroy/' . $pb->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data: {{ $pb->nama_pb }}?')" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Paging (jika menggunakan Laravel pagination) --}}
            {{-- <div class="mt-3">
                {{ $pbs->links() }}
            </div> --}}

        </div>
    </div>
</div>

{{-- Animasi Placeholder (Diubah untuk PB) --}}
<script>
// DIUBAH: Placeholders disesuaikan dengan Potensi Bahaya
const placeholders = ["Cari Potensi Bahaya", "Cari Data", "Filter"];
let current = 0;
let index = 0;
let isDeleting = false;
const speed = 100;
const delay = 1500;
const input = document.getElementById("searchInput");

function typePlaceholder() {
    const currentPlaceholder = placeholders[current];
    if (isDeleting) {
        input.placeholder = currentPlaceholder.substring(0, index);
        index--;
        if (index < 0) {
            isDeleting = false;
            current = (current + 1) % placeholders.length;
        }
    } else {
        input.placeholder = currentPlaceholder.substring(0, index);
        index++;
        if (index > currentPlaceholder.length) {
            isDeleting = true;
            setTimeout(typePlaceholder, delay);
            return;
        }
    }
    setTimeout(typePlaceholder, speed);
}

if (!input.value) {
    typePlaceholder();
}
</script>

@endsection

{{---------------------------------------------------------------------------------}}
{{--- SECTION MODALS: Modal untuk Data Master PB --}}
{{---------------------------------------------------------------------------------}}
@section('modals')

{{-- Modal Tambah PB --}}
{{-- DIUBAH: ID modal dari addPtaModal -> addPbModal --}}
<div class="modal fade" id="addPbModal" tabindex="-1" aria-labelledby="addPbModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                {{-- DIUBAH: Tambah Perilaku Tidak Aman -> Tambah Potensi Bahaya --}}
                <h5 class="modal-title" id="addPbModalLabel"><i class="bi bi-plus-circle-fill me-1"></i> Tambah Potensi Bahaya</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- DIUBAH: rute /pta/store -> /pb/store --}}
                <form action="{{ url('/she/master/pb/store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        {{-- DIUBAH: label dan nama input dari nama_pta -> nama_pb --}}
                        <label for="nama_pb" class="form-label">Potensi Bahaya <span class="text-danger">*</span></label>
                        <textarea name="nama_pb" id="nama_pb" class="form-control" rows="3" required></textarea>
                        {{-- DIUBAH: Contoh disesuaikan dengan Potensi Bahaya --}}
                        <small class="form-text text-muted">Contoh: Kabel terkelupas, lantai licin.</small>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal Edit PB --}}
{{-- DIUBAH: $ptas -> $pbs --}}
@foreach($pbs as $pb)
@if(isset($permission) && $permission->can_edit)
{{-- DIUBAH: ID modal dari editPtaModal -> editPbModal dan variabel $pta->id -> $pb->id --}}
<div class="modal fade" id="editPbModal{{ $pb->id }}" tabindex="-1" aria-labelledby="editPbModalLabel{{ $pb->id }}" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                {{-- DIUBAH: Edit Data dan variabel data $pta->nama_pta -> $pb->nama_pb --}}
                <h5 class="modal-title" id="editPbModalLabel{{ $pb->id }}"><i class="bi bi-pencil-square me-1"></i> Edit Data: {{ Str::limit($pb->nama_pb, 30) }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- DIUBAH: rute /pta/update/ -> /pb/update/ dan variabel $pta->id -> $pb->id --}}
                <form action="{{ url('/she/master/pb/update/' . $pb->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        {{-- DIUBAH: label, id, nama input, dan value dari nama_pta -> nama_pb --}}
                        <label for="edit_nama_pb{{ $pb->id }}" class="form-label">Potensi Bahaya <span class="text-danger">*</span></label>
                        <textarea name="nama_pb" id="edit_nama_pb{{ $pb->id }}" class="form-control" rows="3" required>{{ $pb->nama_pb }}</textarea>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

@endsection