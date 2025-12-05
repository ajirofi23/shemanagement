@extends('layout.sidebar')

@section('content')

{{-- UBAH p-4 MENJADI p-3 pada div content --}}
<div class="content p-3">

    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Menggunakan H3 agar tidak terlalu besar --}}
        <h3 style="color:#0f172a;" class="fw-bold">
            {{-- ICON disesuaikan dengan Data Master --}}
            <i class="bi bi-database-fill-gear me-2 text-primary"></i> Data Master: Perilaku Tidak Aman (PTA)
        </h3>
        
        {{-- Tombol Tambah PTA --}}
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addPtaModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Data Baru
        </button>
    </div>
    
    <hr class="mb-4">

    <div class="card shadow-lg border-0">
        {{-- UBAH p-4 MENJADI p-3 pada card-body --}}
        <div class="card-body p-3">
            <h5 class="card-title mb-3 fs-5 text-secondary">
                <i class="bi bi-list-columns-reverse me-1"></i> Daftar Perilaku Tidak Aman
            </h5>

            {{-- Search & Export --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Search --}}
                {{-- ENDPOINT disesuaikan ke rute PTA --}}
                <form action="{{ url('/she/master/pta') }}" method="GET" class="d-flex flex-grow-1 me-3">
                    <div class="input-group">
                        {{-- Menggunakan form-control standar --}}
                        <input type="text" id="searchInput" name="search" value="{{ request('search') }}" class="form-control border-primary" style="max-width: 300px;" placeholder="">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>

                {{-- Export (ENDPOINT disesuaikan) --}}
                <a href="{{ url('/she/master/pta/export') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export CSV
                </a>
            </div>

            {{-- Tabel PTA --}}
            <div class="table-responsive">
                {{-- Mengubah kelas table-sm menjadi standar karena kolom lebih sedikit --}}
                <table class="table table-hover table-striped mt-3 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 50px;">#</th>
                            <th scope="col">Perilaku Tidak Aman</th>
                            <th scope="col" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Mengganti $users dengan $ptas --}}
                        @foreach($ptas as $pta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $pta->nama_pta }}</td>
                            <td>
                                {{-- Tombol Edit (data-bs-target disesuaikan) --}}
                                @if(isset($permission) && $permission->can_edit)
                                <button type="button" class="btn btn-sm btn-primary me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editPtaModal{{ $pta->id }}"
                                    title="Edit Data">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @endif

                                {{-- Tombol Delete (ENDPOINT disesuaikan) --}}
                                @if(isset($permission) && $permission->can_delete)
                                <form action="{{ url('/she/master/pta/destroy/' . $pta->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data: {{ $pta->nama_pta }}?')" title="Hapus Data">
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
                {{ $ptas->links() }}
            </div> --}}

        </div>
    </div>
</div>

{{-- Animasi Placeholder (Tidak diubah) --}}
<script>
const placeholders = ["Cari Perilaku Tidak Aman", "Cari Data", "Filter"];
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
{{--- SECTION MODALS: Modal untuk Data Master PTA --}}
{{---------------------------------------------------------------------------------}}
@section('modals')

{{-- Modal Tambah PTA --}}
<div class="modal fade" id="addPtaModal" tabindex="-1" aria-labelledby="addPtaModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addPtaModalLabel"><i class="bi bi-plus-circle-fill me-1"></i> Tambah Perilaku Tidak Aman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- ENDPOINT disesuaikan ke rute PTA --}}
                <form action="{{ url('/she/master/pta/store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pta" class="form-label">Perilaku Tidak Aman <span class="text-danger">*</span></label>
                        <textarea name="nama_pta" id="nama_pta" class="form-control" rows="3" required></textarea>
                        <small class="form-text text-muted">Contoh: Tidak menggunakan APD dengan benar.</small>
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


{{-- Modal Edit PTA --}}
{{-- Mengganti $users dengan $ptas --}}
@foreach($ptas as $pta)
@if(isset($permission) && $permission->can_edit)
<div class="modal fade" id="editPtaModal{{ $pta->id }}" tabindex="-1" aria-labelledby="editPtaModalLabel{{ $pta->id }}" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editPtaModalLabel{{ $pta->id }}"><i class="bi bi-pencil-square me-1"></i> Edit Data: {{ Str::limit($pta->nama_pta, 30) }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- ENDPOINT disesuaikan ke rute PTA --}}
                <form action="{{ url('/she/master/pta/update/' . $pta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="edit_nama_pta{{ $pta->id }}" class="form-label">Perilaku Tidak Aman <span class="text-danger">*</span></label>
                        <textarea name="nama_pta" id="edit_nama_pta{{ $pta->id }}" class="form-control" rows="3" required>{{ $pta->nama_pta }}</textarea>
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