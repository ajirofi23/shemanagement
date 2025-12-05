@extends('layout.picsidebar')

@section('content')

{{-- UBAH p-4 MENJADI p-3 pada div content --}}
<div class="content p-3">

    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Menggunakan H3 untuk Laporan Hyari Hatto --}}
        <h3 style="color:#0f172a;" class="fw-bold">
            {{-- ICON disesuaikan dengan Laporan --}}
            <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i> Laporan Hyari Hatto (Near Miss)
        </h3>
        
        {{-- Tombol Tambah Laporan --}}
        <button type="button" class="btn btn-warning shadow-sm text-dark" data-bs-toggle="modal" data-bs-target="#addHyariHattoModal">
            <i class="bi bi-plus-circle me-1"></i> Buat Laporan Baru
        </button>
    </div>
    
    <hr class="mb-4">

    <div class="card shadow-lg border-0">
        {{-- UBAH p-4 MENJADI p-3 pada card-body --}}
        <div class="card-body p-3">
            <h5 class="card-title mb-3 fs-5 text-secondary">
                <i class="bi bi-list-columns-reverse me-1"></i> Daftar Laporan Hyari Hatto
            </h5>

            {{-- Search & Export --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Search --}}
                {{-- ENDPOINT disesuaikan ke rute Hyari Hatto --}}
                <form action="{{ url('/she/report/hyarihatto') }}" method="GET" class="d-flex flex-grow-1 me-3">
                    <div class="input-group">
                        {{-- Menggunakan form-control standar --}}
                        <input type="text" id="searchInput" name="search" value="{{ request('search') }}" class="form-control border-warning" style="max-width: 300px;" placeholder="">
                        <button type="submit" class="btn btn-warning text-dark">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>

                {{-- Export (ENDPOINT disesuaikan) --}}
                <a href="{{ url('/she/report/hyarihatto/export') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export CSV
                </a>
            </div>

            {{-- Tabel Hyari Hatto --}}
            <div class="table-responsive">
                {{-- Mengubah kelas tabel untuk menampung lebih banyak kolom --}}
                <table class="table table-hover table-striped mt-3 align-middle table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 30px;">No</th>
                            <th scope="col" style="width: 15%;">Perilaku Tidak Aman</th>
                            <th scope="col" style="width: 15%;">Kondisi Tidak Aman</th>
                            <th scope="col" style="width: 10%;">Potensi Bahaya</th>
                            <th scope="col" style="width: 20%;">Deskripsi</th>
                            <th scope="col" style="width: 15%;">Rekomendasi P2K3</th>
                            <th scope="col" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Mengganti $ptas dengan $hyarihattos --}}
                        @foreach($hyarihattos as $laporan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- Mengambil deskripsi dari tabel master melalui relasi. Asumsi nama_pta, nama_kta, nama_pb --}}
                            <td>{{ $laporan->pta->nama_pta ?? 'N/A' }}</td>
                            <td>{{ $laporan->kta->nama_kta ?? 'N/A' }}</td>
                            <td><span class="badge bg-danger">{{ $laporan->pb->nama_pb ?? 'N/A' }}</span></td>
                            <td>{{ Str::limit($laporan->deskripsi, 50) }}</td>
                            <td>{{ Str::limit($laporan->rekomendasi, 50) }}</td>
                            <td>
                                {{-- Tombol Detail/Edit --}}
                                @if(isset($permission) && $permission->can_edit)
                                <button type="button" class="btn btn-sm btn-primary me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editHyariHattoModal{{ $laporan->id }}"
                                    title="Edit/Lihat Detail">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @endif

                                {{-- Tombol Delete (ENDPOINT disesuaikan) --}}
                                @if(isset($permission) && $permission->can_delete)
                                <form action="{{ url('/she/report/hyarihatto/destroy/' . $laporan->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus Laporan Hyari Hatto ini?')" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif

                                {{-- Tombol Download Bukti (Asumsi 'bukti' adalah path file) --}}
                                <a href="{{ asset('storage/' . $laporan->bukti) }}" target="_blank" class="btn btn-sm btn-info text-white" title="Download Bukti">
                                    <i class="bi bi-download"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Paging (jika menggunakan Laravel pagination) --}}
            {{-- <div class="mt-3">
                {{ $hyarihattos->links() }}
            </div> --}}

        </div>
    </div>
</div>

{{-- Animasi Placeholder (Dibiarkan sama) --}}
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
{{--- SECTION MODALS: Modal untuk Laporan Hyari Hatto --}}
{{---------------------------------------------------------------------------------}}
@section('modals')

{{-- Modal Tambah Hyari Hatto --}}
<div class="modal fade" id="addHyariHattoModal" tabindex="-1" aria-labelledby="addHyariHattoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="addHyariHattoModalLabel"><i class="bi bi-plus-circle-fill me-1"></i> Buat Laporan Hyari Hatto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- ENDPOINT disesuaikan ke rute Hyari Hatto. Tambahkan 'enctype' untuk upload file --}}
                <form action="{{ url('/she/report/hyarihatto/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pta_id" class="form-label">Perilaku Tidak Aman <span class="text-danger">*</span></label>
                            {{-- Asumsi data master PTA tersedia dalam variabel $masterPtas --}}
                            <select name="pta_id" id="pta_id" class="form-select" required>
                                <option value="">-- Pilih PTA --</option>
                                {{-- @foreach($masterPtas as $pta)
                                    <option value="{{ $pta->id }}">{{ $pta->nama_pta }}</option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="kta_id" class="form-label">Kondisi Tidak Aman <span class="text-danger">*</span></label>
                            {{-- Asumsi data master KTA tersedia dalam variabel $masterKtas --}}
                            <select name="kta_id" id="kta_id" class="form-select" required>
                                <option value="">-- Pilih KTA --</option>
                                {{-- @foreach($masterKtas as $kta)
                                    <option value="{{ $kta->id }}">{{ $kta->nama_kta }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pb_id" class="form-label">Potensi Bahaya <span class="text-danger">*</span></label>
                        {{-- Asumsi data master PB tersedia dalam variabel $masterPbs --}}
                        <select name="pb_id" id="pb_id" class="form-select" required>
                            <option value="">-- Pilih Potensi Bahaya --</option>
                            {{-- @foreach($masterPbs as $pb)
                                <option value="{{ $pb->id }}">{{ $pb->nama_pb }}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Kejadian (Detail) <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
                        <small class="form-text text-muted">Jelaskan secara rinci kejadian atau temuan PTA/KTA.</small>
                    </div>

                    <div class="mb-3">
                        <label for="usulan" class="form-label">Usulan Tindakan Koreksi (Dari Pelapor) <span class="text-danger">*</span></label>
                        <textarea name="usulan" id="usulan" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Bukti (Gambar/Foto) <span class="text-danger">*</span></label>
                        <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*" required>
                        <small class="form-text text-muted">Lampirkan foto kejadian/temuan.</small>
                    </div>
                    
                    {{-- Rekomendasi P2K3 dikosongkan saat input awal (biasanya diisi saat tindak lanjut) --}}
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                        <button type="submit" class="btn btn-warning text-dark"><i class="bi bi-save me-1"></i> Simpan Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal Edit/Detail Hyari Hatto --}}
{{-- Mengganti $ptas dengan $hyarihattos --}}
@foreach($hyarihattos as $laporan)
@if(isset($permission) && $permission->can_edit)
<div class="modal fade" id="editHyariHattoModal{{ $laporan->id }}" tabindex="-1" aria-labelledby="editHyariHattoModalLabel{{ $laporan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editHyariHattoModalLabel{{ $laporan->id }}"><i class="bi bi-pencil-square me-1"></i> Detail/Edit Laporan #{{ $laporan->id }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- ENDPOINT disesuaikan ke rute Hyari Hatto --}}
                <form action="{{ url('/she/report/hyarihatto/update/' . $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit_pta_id_{{ $laporan->id }}" class="form-label">Perilaku Tidak Aman</label>
                            <select name="pta_id" id="edit_pta_id_{{ $laporan->id }}" class="form-select" required>
                                {{-- @foreach($masterPtas as $pta)
                                    <option value="{{ $pta->id }}" {{ $laporan->pta_id == $pta->id ? 'selected' : '' }}>{{ $pta->nama_pta }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_kta_id_{{ $laporan->id }}" class="form-label">Kondisi Tidak Aman</label>
                            <select name="kta_id" id="edit_kta_id_{{ $laporan->id }}" class="form-select" required>
                                {{-- @foreach($masterKtas as $kta)
                                    <option value="{{ $kta->id }}" {{ $laporan->kta_id == $kta->id ? 'selected' : '' }}>{{ $kta->nama_kta }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                         <div class="col-md-4 mb-3">
                            <label for="edit_pb_id_{{ $laporan->id }}" class="form-label">Potensi Bahaya</label>
                            <select name="pb_id" id="edit_pb_id_{{ $laporan->id }}" class="form-select" required>
                                {{-- @foreach($masterPbs as $pb)
                                    <option value="{{ $pb->id }}" {{ $laporan->pb_id == $pb->id ? 'selected' : '' }}>{{ $pb->nama_pb }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_deskripsi_{{ $laporan->id }}" class="form-label">Deskripsi Kejadian (Detail)</label>
                        <textarea name="deskripsi" id="edit_deskripsi_{{ $laporan->id }}" class="form-control" rows="3" required>{{ $laporan->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_usulan_{{ $laporan->id }}" class="form-label">Usulan Tindakan Koreksi (Dari Pelapor)</label>
                        <textarea name="usulan" id="edit_usulan_{{ $laporan->id }}" class="form-control" rows="2" required>{{ $laporan->usulan }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_rekomendasi_{{ $laporan->id }}" class="form-label fw-bold text-success">Rekomendasi P2K3 (Tindak Lanjut)</label>
                        {{-- Ini adalah kolom yang sering diisi oleh tim P2K3/HSE --}}
                        <textarea name="rekomendasi" id="edit_rekomendasi_{{ $laporan->id }}" class="form-control" rows="3">{{ $laporan->rekomendasi }}</textarea>
                        <small class="form-text text-muted">Diisi oleh Tim K3/P2K3 sebagai rencana tindakan korektif resmi.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Bukti Saat Ini:</label>
                        @if($laporan->bukti)
                            <a href="{{ asset('storage/' . $laporan->bukti) }}" target="_blank">
                                <img src="{{ asset('storage/' . $laporan->bukti) }}" alt="Bukti" style="max-width: 150px; height: auto;" class="img-thumbnail mb-2">
                            </a>
                        @else
                            <p class="text-muted">Tidak ada gambar bukti terlampir.</p>
                        @endif
                        <input type="file" name="bukti" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti bukti.</small>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

@endsection