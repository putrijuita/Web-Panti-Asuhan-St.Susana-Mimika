<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoDokumentasiController extends Controller
{
    /**
     * Stream video/file for playback (supports range requests for seeking).
     */
    public function stream(VideoDokumentasi $video)
    {
        $path = $video->file_path;
        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $fullPath = Storage::disk('public')->path($path);
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $mimeMap = [
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'mkv' => 'video/x-matroska',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ];
        $mimeType = $mimeMap[$extension] ?? 'application/octet-stream';

        $filesize = filesize($fullPath);
        $stream = fopen($fullPath, 'rb');

        $range = request()->header('Range');
        if ($range) {
            // Parse "bytes=start-end"
            if (preg_match('/bytes=(\d+)-(\d*)/', $range, $m)) {
                $start = (int) $m[1];
                $end = isset($m[2]) && $m[2] !== '' ? (int) $m[2] : $filesize - 1;
                $length = $end - $start + 1;
                fseek($stream, $start);

                return response()->stream(function () use ($stream, $length) {
                    echo fread($stream, $length);
                    fclose($stream);
                }, 206, [
                    'Content-Type' => $mimeType,
                    'Content-Length' => $length,
                    'Content-Range' => sprintf('bytes %d-%d/%d', $start, $end, $filesize),
                    'Accept-Ranges' => 'bytes',
                ]);
            }
        }

        return response()->stream(function () use ($stream) {
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            'Content-Type' => $mimeType,
            'Content-Length' => $filesize,
            'Accept-Ranges' => 'bytes',
        ]);
    }

    public function index()
    {
        return redirect()->route('admin.galeri.index', ['tab' => 'video']);
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
            ->route('admin.galeri.index', ['tab' => 'video'])
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
            ->route('admin.galeri.index', ['tab' => 'video'])
            ->with('success', 'Dokumentasi video berhasil diperbarui.');
    }

    public function destroy(VideoDokumentasi $video)
    {
        if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
            Storage::disk('public')->delete($video->file_path);
        }

        $video->delete();

        return redirect()
            ->route('admin.galeri.index', ['tab' => 'video'])
            ->with('success', 'Dokumentasi video berhasil dihapus.');
    }
}

