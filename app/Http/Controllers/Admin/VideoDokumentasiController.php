<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoDokumentasiController extends Controller
{
    public function index()
    {
        $videos = VideoDokumentasi::latest()->paginate(10);

        return view('admin.dokumentasi-video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.dokumentasi-video.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'video' => 'required',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $path = $request->file('video')->store('videos/dokumentasi', 'public');

        VideoDokumentasi::create([
            'file_path' => $path,
            'nama' => $validated['nama'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()
            ->route('admin.dokumentasi-video.index')
            ->with('success', 'Dokumentasi video berhasil ditambahkan.');
    }

    public function edit(VideoDokumentasi $video)
    {
        return view('admin.dokumentasi-video.edit', compact('video'));
    }

    public function update(Request $request, VideoDokumentasi $video)
    {
        $validated = $request->validate([
            'video' => 'nullable',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('video')) {
            if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
                Storage::disk('public')->delete($video->file_path);
            }

            $path = $request->file('video')->store('videos/dokumentasi', 'public');
            $video->file_path = $path;
        }

        $video->nama = $validated['nama'];
        $video->keterangan = $validated['keterangan'] ?? null;
        $video->save();

        return redirect()
            ->route('admin.dokumentasi-video.index')
            ->with('success', 'Dokumentasi video berhasil diperbarui.');
    }

    public function destroy(VideoDokumentasi $video)
    {
        if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
            Storage::disk('public')->delete($video->file_path);
        }

        $video->delete();

        return redirect()
            ->route('admin.dokumentasi-video.index')
            ->with('success', 'Dokumentasi video berhasil dihapus.');
    }
}

