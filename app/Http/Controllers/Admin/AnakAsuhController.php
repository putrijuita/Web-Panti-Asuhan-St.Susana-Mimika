<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnakAsuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AnakAsuhController extends Controller
{
    public function index(Request $request)
    {
        if (! Schema::hasTable('anak_asuh')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel `anak_asuh` belum ada. Jalankan `php artisan migrate` di environment database yang dipakai (sqlite/mysql/pgsql).');
        }

        $search = $request->get('search');
        $sekolah = $request->get('sekolah');

        $items = AnakAsuh::query()
            ->when($search, function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nama_panggilan', 'like', "%{$search}%")
                    ->orWhere('asal_daerah', 'like', "%{$search}%");
            })
            ->when($sekolah !== null && $sekolah !== '', function ($q) use ($sekolah) {
                $q->where('sekolah', (bool) $sekolah);
            })
            ->orderBy('nama_lengkap')
            ->paginate(20)
            ->withQueryString();

        return view('admin.anak-asuh.index', [
            'items' => $items,
            'search' => $search,
            'sekolah' => $sekolah,
        ]);
    }

    public function create()
    {
        if (! Schema::hasTable('anak_asuh')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel `anak_asuh` belum ada. Jalankan `php artisan migrate` terlebih dahulu.');
        }

        return view('admin.anak-asuh.create');
    }

    public function store(Request $request)
    {
        if (! Schema::hasTable('anak_asuh')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel `anak_asuh` belum ada. Jalankan `php artisan migrate` terlebih dahulu.');
        }

        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',

            'sekolah' => 'required|boolean',
            'nama_sekolah' => 'nullable|string|max:255',

            'asal_daerah' => 'nullable|string|max:255',
            'alamat_detail' => 'nullable|string',

            'foto' => 'nullable|image|max:1048576',
            'hapus_foto' => 'nullable|boolean',

            'catatan' => 'nullable|string',
        ]);

        if (! $data['sekolah']) {
            $data['nama_sekolah'] = null;
        }

        if ($request->hasFile('foto')) {
            $data['foto_path'] = $request->file('foto')->store('anak-asuh', 'public');
        }

        // jika foto tidak diupload, foto_path otomatis null (tidak masuk $data)
        $anak = AnakAsuh::create($data);

        return redirect()
            ->route('admin.anak-asuh.index')
            ->with('success', 'Data anak asuh berhasil ditambahkan.');
    }

    public function show(AnakAsuh $anakAsuh)
    {
        return view('admin.anak-asuh.show', ['item' => $anakAsuh]);
    }

    public function edit(AnakAsuh $anakAsuh)
    {
        return view('admin.anak-asuh.edit', ['item' => $anakAsuh]);
    }

    public function update(Request $request, AnakAsuh $anakAsuh)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',

            'sekolah' => 'required|boolean',
            'nama_sekolah' => 'nullable|string|max:255',

            'asal_daerah' => 'nullable|string|max:255',
            'alamat_detail' => 'nullable|string',

            'foto' => 'nullable|image|max:1048576',
            'hapus_foto' => 'nullable|boolean',

            'catatan' => 'nullable|string',
        ]);

        if (! $data['sekolah']) {
            $data['nama_sekolah'] = null;
        }

        if ($request->boolean('hapus_foto') && $anakAsuh->foto_path) {
            Storage::disk('public')->delete($anakAsuh->foto_path);
            $data['foto_path'] = null;
        }

        if ($request->hasFile('foto')) {
            if ($anakAsuh->foto_path) {
                Storage::disk('public')->delete($anakAsuh->foto_path);
            }
            $data['foto_path'] = $request->file('foto')->store('anak-asuh', 'public');
        }

        $anakAsuh->update($data);

        return redirect()
            ->route('admin.anak-asuh.index')
            ->with('success', 'Data anak asuh berhasil diperbarui.');
    }

    public function destroy(AnakAsuh $anakAsuh)
    {
        if ($anakAsuh->foto_path) {
            Storage::disk('public')->delete($anakAsuh->foto_path);
        }

        $anakAsuh->delete();

        return redirect()
            ->route('admin.anak-asuh.index')
            ->with('success', 'Data anak asuh berhasil dihapus.');
    }
}
