<?php

namespace App\Http\Controllers\SHE; // Sesuaikan namespace jika perlu

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\HyariHatto;
use App\Models\Pta; // Asumsi model untuk tb_master_pta
use App\Models\Kta; // Asumsi model untuk tb_master_kta
use App\Models\Pb;  // Asumsi model untuk tb_master_pb
use Illuminate\Support\Str;

class HyariHattoController extends Controller
{
    /**
     * Menampilkan daftar laporan Hyari Hatto (fungsi INDEX).
     * Meneruskan data laporan dan data master untuk modal.
     */
    public function index(Request $request)
    {
        // 1. Ambil data laporan dengan relasi (eager loading)
        $hyarihattos = HyariHatto::with(['pta', 'kta', 'pb'])
            ->when($request->search, function ($query, $search) {
                // Contoh filter berdasarkan deskripsi atau relasi
                $query->where('deskripsi', 'like', '%' . $search . '%')
                      ->orWhereHas('pta', function ($q) use ($search) {
                          $q->where('nama_pta', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('kta', function ($q) use ($search) {
                          $q->where('nama_kta', 'like', '%' . $search . '%');
                      });
            })
            ->orderBy('created_at', 'desc')
            ->get(); // Atau ->paginate(10) jika ingin pagination

        // 2. Ambil data master untuk Dropdown di Modal Tambah/Edit
        $masterPtas = Pta::all();
        $masterKtas = Kta::all();
        $masterPbs = Pb::all();
        
        // Asumsi variabel $permission juga tersedia di sini
        $permission = (object)['can_edit' => true, 'can_delete' => true]; // Ganti dengan logika izin Anda

        return view('she.report.hyarihatto.index', compact('hyarihattos', 'masterPtas', 'masterKtas', 'masterPbs', 'permission'));
    }

    // --- Fungsi Create/Store ---

    /**
     * Menyimpan laporan Hyari Hatto baru (fungsi STORE).
     */
    public function store(Request $request)
    {
        $request->validate([
            'pta_id' => 'required|exists:tb_master_pta,id',
            'kta_id' => 'required|exists:tb_master_kta,id',
            'pb_id' => 'required|exists:tb_master_pb,id',
            'deskripsi' => 'required|string|max:1000',
            'usulan' => 'required|string|max:1000',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // Upload Gambar Bukti
        $path_bukti = null;
        if ($request->hasFile('bukti')) {
            // Simpan di folder 'hyarihatto_bukti' di dalam storage/app/public
            $path_bukti = $request->file('bukti')->store('hyarihatto_bukti', 'public');
        }

        // Simpan data ke database
        HyariHatto::create([
            'pta_id' => $request->pta_id,
            'kta_id' => $request->kta_id,
            'pb_id' => $request->pb_id,
            'deskripsi' => $request->deskripsi,
            'usulan' => $request->usulan,
            'bukti' => $path_bukti,
            // 'rekomendasi' dibiarkan kosong (null) saat laporan dibuat
            'rekomendasi' => null, 
        ]);

        return redirect()->back()->with('success', 'Laporan Hyari Hatto berhasil dibuat.');
    }

    // --- Fungsi Update ---

    /**
     * Memperbarui data laporan Hyari Hatto (fungsi UPDATE).
     */
    public function update(Request $request, $id)
    {
        $laporan = HyariHatto::findOrFail($id);

        $request->validate([
            'pta_id' => 'required|exists:tb_master_pta,id',
            'kta_id' => 'required|exists:tb_master_kta,id',
            'pb_id' => 'required|exists:tb_master_pb,id',
            'deskripsi' => 'required|string|max:1000',
            'usulan' => 'required|string|max:1000',
            'rekomendasi' => 'nullable|string|max:1000', // P2K3 bisa mengupdate ini
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses Update Bukti (jika ada file baru)
        $path_bukti = $laporan->bukti;
        if ($request->hasFile('bukti')) {
            // Hapus gambar lama (jika ada)
            if ($laporan->bukti) {
                Storage::disk('public')->delete($laporan->bukti);
            }
            // Upload gambar baru
            $path_bukti = $request->file('bukti')->store('hyarihatto_bukti', 'public');
        }

        // Update data
        $laporan->update([
            'pta_id' => $request->pta_id,
            'kta_id' => $request->kta_id,
            'pb_id' => $request->pb_id,
            'deskripsi' => $request->deskripsi,
            'usulan' => $request->usulan,
            'rekomendasi' => $request->rekomendasi, // Memasukkan Rekomendasi P2K3
            'bukti' => $path_bukti,
        ]);

        return redirect()->back()->with('success', 'Laporan Hyari Hatto berhasil diperbarui.');
    }

    // --- Fungsi Delete ---

    /**
     * Menghapus laporan Hyari Hatto (fungsi DESTROY).
     */
    public function destroy($id)
    {
        $laporan = HyariHatto::findOrFail($id);

        // Hapus file gambar bukti dari storage
        if ($laporan->bukti) {
            Storage::disk('public')->delete($laporan->bukti);
        }

        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan Hyari Hatto berhasil dihapus.');
    }

    // --- Fungsi Export (Opsional) ---

    // public function export()
    // {
    //     // Logika untuk export ke CSV/Excel
    // }
}