@extends('layout.itsidebar')

@section('content')

{{-- UBAH p-4 MENJADI p-3 pada div content --}}
<div class="content p-3">

    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- Menggunakan H3 agar tidak terlalu besar --}}
        <h3 style="color:#0f172a;" class="fw-bold">
            <i class="bi bi-people-fill me-2 text-primary"></i> Manajemen Pengguna
        </h3>
        
        {{-- Tombol Tambah User --}}
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah User Baru
        </button>
    </div>
    
    <hr class="mb-4">

    <div class="card shadow-lg border-0">
        {{-- UBAH p-4 MENJADI p-3 pada card-body --}}
        <div class="card-body p-3">
            <h5 class="card-title mb-3 fs-5 text-secondary">
                <i class="bi bi-list-columns-reverse me-1"></i> Daftar User Aktif
            </h5>

            {{-- Search & Export --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Search --}}
                <form action="{{ url('/it/management-user') }}" method="GET" class="d-flex flex-grow-1 me-3">
                    <div class="input-group">
                        {{-- Menggunakan form-control standar --}}
                        <input type="text" id="searchInput" name="search" value="{{ request('search') }}" class="form-control border-primary" style="max-width: 300px;" placeholder="">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>

                {{-- Export --}}
                <a href="#" class="btn btn-success shadow-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export CSV
                </a>
            </div>

            {{-- Tabel User --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-sm mt-3 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Section</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Kode User</th>
                            <th scope="col">Aktif?</th>
                            <th scope="col">Level</th>
                            <th scope="col">Komputer?</th>
                            <th scope="col">Sign</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $user->nama }}</td>
                            <td>{{ $user->section_id }}</td>
                            <td>{{ $user->usr }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->no_hp }}</td>
                            <td>{{ $user->kode_user }}</td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Yes</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> No</span>
                                @endif
                            </td>
                            <td><span class="badge bg-info text-dark">{{ strtoupper($user->level) }}</span></td>
                            <td>{{ $user->is_user_computer ? 'Yes' : 'No' }}</td>
                            <td>
                                @if($user->image_sign)
                                    <img src="{{ asset('images/sign/' . $user->image_sign) }}" width="40" class="img-thumbnail">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{-- Tombol Edit --}}
                                @if(isset($permission) && $permission->can_edit)
                                <button type="button" class="btn btn-sm btn-primary me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editUserModal{{ $user->id }}"
                                    title="Edit User">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @endif

                                {{-- Tombol Delete --}}
                                @if(isset($permission) && $permission->can_delete)
                                <form action="{{ url('/it/management-user/destroy/' . $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user {{ $user->nama }}?')" title="Hapus User">
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
                {{ $users->links() }}
            </div> --}}

        </div>
    </div>
</div>

{{-- Animasi Placeholder (Tidak diubah) --}}
<script>
const placeholders = ["Cari Nama", "Cari Username", "Cari Kode User", "Cari Email"];
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
{{--- SECTION MODALS: Penyesuaian 'required' pada Section, Level, dan Email ---}}
{{---------------------------------------------------------------------------------}}
@section('modals')

{{-- Modal Tambah User (DIUBAH: Section, Level, Email tidak required) --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUserModalLabel"><i class="bi bi-person-plus-fill me-1"></i> Tambah User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/it/management-user/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" name="nama" class="form-control" required></div>
                            <div class="mb-3"><label class="form-label">Username <span class="text-danger">*</span></label><input type="text" name="usr" class="form-control" required></div>
                            <div class="mb-3"><label class="form-label">Password <span class="text-danger">*</span></label><input type="password" name="password" class="form-control" required></div>
                            
                            {{-- EMAIL TIDAK WAJIB (REQUIRED DIHAPUS) --}}
                            <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
                            
                            <div class="mb-3"><label class="form-label">No HP</label><input type="text" name="no_hp" class="form-control"></div>
                        </div>
                        <div class="col-12 col-md-6">
                            
                            {{-- SECTION TIDAK WAJIB (REQUIRED DIHAPUS + OPSI TIDAK ADA) --}}
                            <div class="mb-3">
                                <label class="form-label">Section</label>
                                <select name="section_id" class="form-select">
                                    <option value="">Tidak Ada</option>
                                    <option value="1">IT</option>
                                </select>
                            </div>
                            
                            {{-- LEVEL TIDAK WAJIB (REQUIRED DIHAPUS + OPSI TIDAK ADA) --}}
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <select name="level" class="form-select">
                                    <option value="">Tidak Ada</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="it">IT</option>
                                </select>
                            </div>
                            
                            <div class="mb-3 row">
                                <div class="col-6"><label class="form-label">Status Aktif <span class="text-danger">*</span></label><select name="is_active" class="form-select" required><option value="1">Aktif</option><option value="0">Nonaktif</option></select></div>
                                <div class="col-6"><label class="form-label">User Komputer? <span class="text-danger">*</span></label><select name="is_user_computer" class="form-select" required><option value="0">Tidak</option><option value="1">Ya</option></select></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Kode User</label><input type="text" name="kode_user" class="form-control"></div>
                            <div class="mb-3"><label class="form-label">Image Sign</label><input type="file" name="image_sign" class="form-control" accept="image/*"></div>
                        </div>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal Edit User (DIUBAH: Section, Level, Email tidak required) --}}
@foreach($users as $user)
@if(isset($permission) && $permission->can_edit)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}"><i class="bi bi-person-lines-fill me-1"></i> Edit User: {{ $user->nama }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/it/management-user/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                        @method('PUT')
                    
                    {{-- Layout Dua Kolom Ringkas --}}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="nama{{ $user->id }}" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="nama{{ $user->id }}" class="form-control" value="{{ $user->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="usr{{ $user->id }}" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" name="usr" id="usr{{ $user->id }}" class="form-control" value="{{ $user->usr }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password{{ $user->id }}" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" id="password{{ $user->id }}" class="form-control" placeholder="•••••••">
                            </div>
                            
                            {{-- EMAIL TIDAK WAJIB (REQUIRED DIHAPUS + TANDA BINTANG DIHAPUS) --}}
                            <div class="mb-3">
                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                <input type="email" name="email" id="email{{ $user->id }}" class="form-control" value="{{ $user->email }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_hp{{ $user->id }}" class="form-label">No HP</label>
                                <input type="text" name="no_hp" id="no_hp{{ $user->id }}" class="form-control" value="{{ $user->no_hp }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            {{-- SECTION TIDAK WAJIB (REQUIRED DIHAPUS + TANDA BINTANG DIHAPUS + OPSI TIDAK ADA) --}}
                            <div class="mb-3">
                                <label for="section_id{{ $user->id }}" class="form-label">Section</label>
                                <select name="section_id" id="section_id{{ $user->id }}" class="form-select">
                                    <option value="" {{ is_null($user->section_id) || $user->section_id == '' ? 'selected' : '' }}>Tidak Ada</option>
                                    {{-- **TODO:** Ganti dengan data Section dari database (misal: $sections) --}}
                                    <option value="1" {{ $user->section_id == 1 ? 'selected' : '' }}>IT</option>
                                    <option value="2" {{ $user->section_id == 2 ? 'selected' : '' }}>HRD</option>
                                    <option value="3" {{ $user->section_id == 3 ? 'selected' : '' }}>PRODUKSI</option>
                                </select>
                            </div>
                            
                            {{-- LEVEL TIDAK WAJIB (REQUIRED DIHAPUS + TANDA BINTANG DIHAPUS + OPSI TIDAK ADA) --}}
                            <div class="mb-3">
                                <label for="level{{ $user->id }}" class="form-label">Level</label>
                                <select name="level" id="level{{ $user->id }}" class="form-select">
                                    <option value="" {{ is_null($user->level) || $user->level == '' ? 'selected' : '' }}>Tidak Ada</option>
                                    <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="it" {{ $user->level == 'it' ? 'selected' : '' }}>IT</option>
                                </select>
                            </div>
                            
                            {{-- Status Aktif dan User Komputer tetap wajib diisi (REQUIRED TETAP ADA) --}}
                            <div class="mb-3 row">
                                <div class="col-6">
                                    <label for="is_active{{ $user->id }}" class="form-label">Status Aktif <span class="text-danger">*</span></label>
                                    <select name="is_active" id="is_active{{ $user->id }}" class="form-select" required>
                                        <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="is_user_computer{{ $user->id }}" class="form-label">User Komputer? <span class="text-danger">*</span></label>
                                    <select name="is_user_computer" id="is_user_computer{{ $user->id }}" class="form-select" required>
                                        <option value="1" {{ $user->is_user_computer == 1 ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ $user->is_user_computer == 0 ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="kode_user{{ $user->id }}" class="form-label">Kode User</label>
                                <input type="text" name="kode_user" id="kode_user{{ $user->id }}" class="form-control" value="{{ $user->kode_user }}">
                            </div>
                            <div class="mb-3">
                                <label for="image_sign{{ $user->id }}" class="form-label">Image Sign (Tanda Tangan)</label>
                                <input type="file" name="image_sign" id="image_sign{{ $user->id }}" class="form-control" accept="image/*">
                                @if($user->image_sign)
                                    <small class="form-text text-muted">Saat ini: <a href="{{ asset('images/sign/' . $user->image_sign) }}" target="_blank">Lihat Tanda Tangan</a></small>
                                @else
                                    <small class="form-text text-muted">Belum ada tanda tangan</small>
                                @endif
                            </div>
                        </div>
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