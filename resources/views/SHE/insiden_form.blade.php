{{-- include header + sidebar --}}
@include('layout.header')
@extends('layout.sidebar')

@section('content')
<style>
    /* RESET BOX MODEL */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    /* ANIMASI GLOBAL (tanpa transform, hanya opacity) */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes fadeUp { from { opacity: 0; } to { opacity: 1; } }
    @keyframes fadeScale { from { opacity: 0; } to { opacity: 1; } }

    /* WRAPPER */
    .content-wrapper {
        position: relative;
        padding: 32px;
        margin-left: 260px;
        margin-top: 64px;
        animation: fadeIn 600ms ease-out;
    }
    @media (max-width: 991px) { .content-wrapper { margin-left: 0; padding: 22px; } }

    /* TITLE */
    .page-title { font-size: 32px; font-weight: 800; color: #0f172a; margin-bottom: 6px; letter-spacing: -1px; animation: fadeUp 600ms ease; }
    .page-sub { font-size: 15px; color: #64748b; margin-bottom: 28px; animation: fadeUp 750ms ease; }

    /* CARD */
    .form-card {
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 18px;
        box-shadow: 0 10px 28px rgba(0,0,0,0.06);
        backdrop-filter: blur(8px);
        overflow: hidden;
        animation: fadeScale 650ms ease-out;
    }
    .section-title { padding: 16px 20px; font-size: 15px; font-weight: 700; color: #111827; background: linear-gradient(to right, #f8fafc, #ffffff); border-bottom: 1px solid #e5e7eb; }
    .section-body { padding: 22px; animation: fadeIn 500ms ease; }

    /* GRID */
    .grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px; }
    .col-3 { grid-column: span 3; } .col-4 { grid-column: span 4; } .col-6 { grid-column: span 6; } .col-12 { grid-column: span 12; }
    @media (max-width: 991px) {
        .grid { grid-template-columns: repeat(1, 1fr); }
        .col-3, .col-4, .col-6, .col-12 { grid-column: span 1; }
    }

    /* LABEL */
    label { font-size: 16px; font-weight: 600; color: #333; margin-bottom: 8px; display: block; }

    /* INPUT FIELDS */
    .form-control, .form-select, .form-textarea {
        width: 100%; padding: 16px 20px; border: 1px solid #dbe1e8; border-radius: 16px; background: #ffffff;
        font-size: 16px; font-family: Arial, Helvetica, sans-serif; transition: 250ms ease;
    }
    .form-control:hover, .form-select:hover, .form-textarea:hover { border-color: #b8c2cc; }
    .form-control:focus, .form-select:focus, .form-textarea:focus { border-color: #3b82f6; background: #f8fbff; box-shadow: 0 5px 14px rgba(59,130,246,0.25); }
    .form-textarea { min-height: 180px; line-height: 24px; resize: vertical; }

    /* BUTTON */
    .btn-primary-aicc {
        padding: 12px 24px; background: #3b82f6; color: white; font-size: 15px; font-weight: 600;
        border-radius: 14px; box-shadow: 0 5px 14px rgba(59,130,246,0.35); border: none; transition: 300ms ease;
    }
    .btn-primary-aicc:hover { background: #2563eb; box-shadow: 0 10px 24px rgba(59,130,246,0.4); }

    /* UPLOAD BOX */
    .upload-box {
        padding: 36px; border: 2px dashed #cbd5e1; border-radius: 18px; font-size: 15px; text-align: center; color: #64748b; background: #ffffff; transition: 300ms ease;
    }
    .upload-box:hover { border-color: #3b82f6; background: #f0f7ff; box-shadow: 0 8px 20px rgba(59,130,246,0.2); }

    /* INPUT ICON */
    .input-icon { position: relative; }
    .input-icon .icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748b; width: 18px; height: 18px; pointer-events: none; display: inline-flex; align-items: center; justify-content: center; }
    .input-icon .form-control { padding-left: 48px; }
</style>

<div class="content-wrapper">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <div class="page-title">Form Laporan Insiden</div>
            <div class="page-sub">Formulir pelaporan Insiden</div>
        </div>
        @if (Route::has('she.insiden.index'))
            <a href="{{ route('she.insiden.index') }}" class="btn-primary-aicc">Kembali</a>
        @else
            <a href="{{ url('/she/insiden') }}" class="btn-primary-aicc">Kembali</a>
        @endif
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:10px 12px; border-radius:10px; margin-bottom:16px;">
            <div style="font-weight:700; margin-bottom:6px;">Terjadi kesalahan pada isian:</div>
            <ul style="margin:0 0 0 18px; padding:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('status'))
        <div style="background:#dcfce7; border:1px solid #86efac; color:#065f46; padding:10px 12px; border-radius:10px; margin-bottom:16px;">
            {{ session('status') }}
        </div>
    @endif

    <form id="insidenForm" action="{{ route('she.insiden.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf

        <div class="section-title">I. Data Insiden</div>
        <div class="section-body">
            <div class="grid">

                <div class="col-3">
                    <label for="tanggal">Tanggal</label>
                    <div class="input-icon">
                        <span class="icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </span>
                        <input type="date" id="tanggal" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Pilih tanggal" value="{{ old('tanggal') }}" max="{{ now()->toDateString() }}" required>
                    </div>
                    @error('tanggal') <small class="error-text">{{ $message }}</small> @enderror
                </div>

                <div class="col-3">
                    <label for="jam">Jam</label>
                    <div class="input-icon">
                        <span class="icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </span>
                        <input type="time" id="jam" name="jam" class="form-control @error('jam') is-invalid @enderror" placeholder="--:--" value="{{ old('jam') }}" required>
                    </div>
                    @error('jam') <small class="error-text">{{ $message }}</small> @enderror
                </div>

                <div class="col-3">
                    <label for="lokasi">Lokasi Kejadian</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Masukkan Lokasi" value="{{ old('lokasi') }}" minlength="3" maxlength="150" required>
                    @error('lokasi') <small class="error-text">{{ $message }}</small> @enderror
                </div>

                <div class="col-3">
                    <label for="kategori">Kategori Accident</label>
                    <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Work Accident" {{ old('kategori') === 'Work Accident' ? 'selected' : '' }}>Work Accident</option>
                        <option value="Traffic Accident" {{ old('kategori') === 'Traffic Accident' ? 'selected' : '' }}>Traffic Accident</option>
                        <option value="Fire Accident" {{ old('kategori') === 'Fire Accident' ? 'selected' : '' }}>Fire Accident</option>
                        <option value="Forklift Accident" {{ old('kategori') === 'Forklift Accident' ? 'selected' : '' }}>Forklift Accident</option>
                        <option value="Molten Spill Incident" {{ old('kategori') === 'Molten Spill Incident' ? 'selected' : '' }}>Molten Spill Incident</option>
                        <option value="Property Damage Incident" {{ old('kategori') === 'Property Damage Incident' ? 'selected' : '' }}>Property Damage Incident</option>
                    </select>
                    @error('kategori') <small class="error-text">{{ $message }}</small> @enderror
                </div>

                <!-- Work Accident dynamic dropdown -->
                <div class="col-3" id="workAccidentDiv" style="display:none;">
                    <label for="work_accident_type">Tipe Work Accident</label>
                    <select id="work_accident_type" name="work_accident_type" class="form-select">
                        <option value="">Pilih Tipe</option>
                        <option value="Loss Day" {{ old('work_accident_type') === 'Loss Day' ? 'selected' : '' }}>Loss Day</option>
                        <option value="Light" {{ old('work_accident_type') === 'Light' ? 'selected' : '' }}>Light</option>
                    </select>
                </div>

                <div class="col-3">
                    <label for="departemen">Departemen</label>
                    <select id="departemen" name="departemen" class="form-select @error('departemen') is-invalid @enderror" required>
                        <option value="">Pilih Dept</option>
                        <option value="Production" {{ old('departemen') === 'Production' ? 'selected' : '' }}>Production</option>
                        <option value="Maintenance" {{ old('departemen') === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="Quality" {{ old('departemen') === 'Quality' ? 'selected' : '' }}>Quality</option>
                        <option value="SHE" {{ old('departemen') === 'SHE' ? 'selected' : '' }}>SHE</option>
                        <option value="IT" {{ old('departemen') === 'IT' ? 'selected' : '' }}>IT</option>
                        <option value="HR" {{ old('departemen') === 'HR' ? 'selected' : '' }}>HR</option>
                    </select>
                    @error('departemen') <small class="error-text">{{ $message }}</small> @enderror
                </div>

                <div class="col-3">
                    <label for="kondisi_luka">Kondisi Luka</label>
                    <input type="text" id="kondisi_luka" name="kondisi_luka" class="form-control @error('kondisi_luka') is-invalid @enderror" placeholder="Masukkan Kondisi" value="{{ old('kondisi_luka') }}" maxlength="200">
                    @error('kondisi_luka') <small class="error-text">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>

        <!-- bagian kronologi, foto, keterangan lain (tidak diubah) -->
        <div class="section-title">II. Kronologi</div>
        <div class="section-body">
            <textarea id="kronologi" name="kronologi" class="form-textarea @error('kronologi') is-invalid @enderror" placeholder="Masukkan Kronologi" maxlength="3000" required>{{ old('kronologi') }}</textarea>
            <div id="kronologiCount" style="font-size:12px; color:#64748b; margin-top:6px;">0 / 3000</div>
            @error('kronologi') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <div class="section-title">III. Foto & Maps</div>
                    <div class="section-body">
                <div class="upload-box">
                    <div>Klik untuk upload gambar</div>
                    <div style="font-size:12px;">Format: JPG, PNG (Max: 10MB / file)</div>

                    <!-- Tombol custom di bawah -->
                    <div style="margin-top:10px; text-align:center;">
                        <label for="foto" style="cursor:pointer; display:inline-block; padding:8px 20px; background:#3b82f6; color:white; border-radius:12px; font-weight:600; font-size:14px; box-shadow:0 5px 14px rgba(59,130,246,0.35); transition:0.3s;">
                            Pilih File
                        </label>
                    </div>

                    <input id="foto" type="file" name="foto[]" accept=".jpg,.jpeg,.png" multiple style="display:none;">
                    <div id="fotoPreview" class="preview-grid"></div>
                    <div id="fotoError" class="error-text" style="display:none;"></div>
                </div>
            </div>


        <div class="section-title">IV. Keterangan Lain</div>
        <div class="section-body">
            <textarea id="keterangan_lain" name="keterangan_lain" class="form-textarea @error('keterangan_lain') is-invalid @enderror" placeholder="Masukkan Keterangan Lain" maxlength="3000">{{ old('keterangan_lain') }}</textarea>
            @error('keterangan_lain') <small class="error-text">{{ $message }}</small> @enderror
        </div>

        <div style="padding:16px; display:flex; justify-content:flex-end; gap:8px;">
            <button id="submitBtn" type="submit" class="btn-primary-aicc">Kirim Laporan</button>
        </div>
    </form>
</div>

<script>
(function () {
    const form = document.getElementById('insidenForm');
    const submitBtn = document.getElementById('submitBtn');
    const fotoInput = document.getElementById('foto');
    const fotoPreview = document.getElementById('fotoPreview');
    const fotoError = document.getElementById('fotoError');
    const kronologi = document.getElementById('kronologi');
    const kronologiCount = document.getElementById('kronologiCount');

    function updateKronologiCount() {
        const max = kronologi.getAttribute('maxlength') || 0;
        kronologiCount.textContent = `${kronologi.value.length} / ${max}`;
    }
    kronologi.addEventListener('input', updateKronologiCount);
    updateKronologiCount();

    const MAX_SIZE = 10 * 1024 * 1024;
    const ALLOWED = ['image/jpeg', 'image/png'];

    function clearPreview() {
        fotoPreview.innerHTML = '';
        fotoError.style.display = 'none';
        fotoError.textContent = '';
    }

    function validateFiles(files) {
        clearPreview();
        let hasError = false;
        Array.from(files).forEach((file) => {
            if (!ALLOWED.includes(file.type) || file.size > MAX_SIZE) {
                hasError = true;
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                const item = document.createElement('div');
                item.className = 'preview-item';
                item.innerHTML = `<img src="${e.target.result}" alt="${file.name}">`;
                fotoPreview.appendChild(item);
            };
            reader.readAsDataURL(file);
        });
        if (hasError) {
            fotoError.textContent = 'Pastikan file bertipe JPG/PNG dan maksimal 10MB per file.';
            fotoError.style.display = 'block';
        }
    }

    fotoInput.addEventListener('change', function () {
        if (!this.files?.length) { clearPreview(); return; }
        validateFiles(this.files);
    });

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Mengirim...';
    });

    // ==== Work Accident dropdown logic ====
    const kategoriSelect = document.getElementById('kategori');
    const workDiv = document.getElementById('workAccidentDiv');

    function toggleWorkAccident() {
        if (kategoriSelect.value === 'Work Accident') {
            workDiv.style.display = 'block';
        } else {
            workDiv.style.display = 'none';
            document.getElementById('work_accident_type').value = '';
        }
    }

    kategoriSelect.addEventListener('change', toggleWorkAccident);
    window.addEventListener('DOMContentLoaded', toggleWorkAccident);
})();
</script>

@endsection
