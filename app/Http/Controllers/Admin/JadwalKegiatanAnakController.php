<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKegiatanAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class JadwalKegiatanAnakController extends Controller
{
    public function index(Request $request)
    {
        if (! Schema::hasTable('jadwal_kegiatan_anak')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel `jadwal_kegiatan_anak` belum ada. Jalankan `php artisan migrate`.');
        }

        $search = $request->get('search');
        $hari = $request->get('hari');
        $aktif = $request->get('aktif');

        $items = JadwalKegiatanAnak::query()
            ->when($search, function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            })
            ->when($hari, function ($q) use ($hari) {
                $q->where('hari', $hari);
            })
            ->when($aktif !== null && $aktif !== '', function ($q) use ($aktif) {
                $q->where('aktif', (bool) $aktif);
            })
            ->orderByRaw("FIELD(hari,'setiap_hari','senin','selasa','rabu','kamis','jumat','sabtu','minggu'), urutan, jam_mulai")
            ->paginate(30)
            ->withQueryString();

        $hariOptions = JadwalKegiatanAnak::daftarHari();

        return view('admin.jadwal-anak.index', [
            'items' => $items,
            'search' => $search,
            'hariOptions' => $hariOptions,
            'hari' => $hari,
            'aktif' => $aktif,
        ]);
    }

    public function create()
    {
        if (! Schema::hasTable('jadwal_kegiatan_anak')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel `jadwal_kegiatan_anak` belum ada. Jalankan `php artisan migrate` terlebih dahulu.');
        }

        $hariOptions = JadwalKegiatanAnak::daftarHari();
        return view('admin.jadwal-anak.create', compact('hariOptions'));
    }

    public function store(Request $request)
    {
        if (! Schema::hasTable('jadwal_kegiatan_anak')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel `jadwal_kegiatan_anak` belum ada. Jalankan `php artisan migrate`.');
        }

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'hari' => 'required|string|max:50',

            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after_or_equal:jam_mulai',

            'lokasi' => 'nullable|string|max:255',
            'aktif' => 'required|boolean',
            'urutan' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        JadwalKegiatanAnak::create($data);

        return redirect()
            ->route('admin.jadwal-anak.index')
            ->with('success', 'Jadwal kegiatan anak berhasil ditambahkan.');
    }

    public function show(JadwalKegiatanAnak $jadwal)
    {
        $hariOptions = JadwalKegiatanAnak::daftarHari();
        return view('admin.jadwal-anak.show', compact('jadwal', 'hariOptions'));
    }

    public function edit(JadwalKegiatanAnak $jadwal)
    {
        $hariOptions = JadwalKegiatanAnak::daftarHari();
        return view('admin.jadwal-anak.edit', compact('jadwal', 'hariOptions'));
    }

    public function update(Request $request, JadwalKegiatanAnak $jadwal)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'hari' => 'required|string|max:50',

            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after_or_equal:jam_mulai',

            'lokasi' => 'nullable|string|max:255',
            'aktif' => 'required|boolean',
            'urutan' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        $jadwal->update($data);

        return redirect()
            ->route('admin.jadwal-anak.index')
            ->with('success', 'Jadwal kegiatan anak berhasil diperbarui.');
    }

    public function destroy(JadwalKegiatanAnak $jadwal)
    {
        $jadwal->delete();

        return redirect()
            ->route('admin.jadwal-anak.index')
            ->with('success', 'Jadwal kegiatan anak berhasil dihapus.');
    }
}

