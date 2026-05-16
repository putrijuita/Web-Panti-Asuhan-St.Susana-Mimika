<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use App\Models\AnakAsuhPageContent;
use App\Models\Galeri;
use App\Models\GaleriCategory;
use App\Models\JadwalKegiatanAnak;
use App\Models\KontakPageContent;
use App\Models\KontakPesan;
use App\Models\StrukturOrganisasi;
use App\Models\VideoDokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function tentang()
    {
        $pengurus = StrukturOrganisasi::orderBy('urutan')
            ->orderBy('created_at')
            ->get();

        $anakAsuh = $this->publicAnakAsuhCollection();
        $anakAsuhPage = AnakAsuhPageContent::resolvedForPublic();

        return view('pages.tentang', compact('pengurus', 'anakAsuh', 'anakAsuhPage'));
    }

    public function program()
    {
        $hariOptions = JadwalKegiatanAnak::daftarHari();
        $jadwalByHari = collect();
        $jadwalTampil = false;

        if (Schema::hasTable('jadwal_kegiatan_anak')) {
            $jadwalByHari = JadwalKegiatanAnak::query()
                ->where('aktif', true)
                ->orderedByHariUrutanJam()
                ->get()
                ->groupBy('hari');

            foreach (array_keys($hariOptions) as $kunciHari) {
                if (($jadwalByHari[$kunciHari] ?? collect())->isNotEmpty()) {
                    $jadwalTampil = true;
                    break;
                }
            }
        }

        return view('pages.program', compact('hariOptions', 'jadwalByHari', 'jadwalTampil'));
    }

    public function programUnggulan()
    {
        return redirect()->route('program', [], 301);
    }

    public function programLainnya()
    {
        return redirect()->route('program', [], 301);
    }

    public function galeri()
    {
        $items = Galeri::latest()->get();
        $videos = VideoDokumentasi::latest()->get();
        $categories = collect();
        if (Schema::hasTable('galeri_categories')) {
            $categories = GaleriCategory::orderBy('nama')->where('nama', '!=', 'Masak')->get();
        }

        return view('pages.galeri', compact('items', 'videos', 'categories'));
    }

    /**
     * Stream video untuk pemutaran di halaman galeri (mendukung range/seek).
     */
    public function streamVideo(VideoDokumentasi $video)
    {
        $path = $video->file_path;
        if (! $path || ! \Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($path);
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
        if ($range && preg_match('/bytes=(\d+)-(\d*)/', $range, $m)) {
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

        return response()->stream(function () use ($stream) {
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            'Content-Type' => $mimeType,
            'Content-Length' => $filesize,
            'Accept-Ranges' => 'bytes',
        ]);
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function kontakStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        if (Schema::hasTable('kontak_pesan')) {
            KontakPesan::create($request->only(['nama', 'email', 'subjek', 'pesan']));
        }

        return redirect()->route('kontak')->with('success', KontakPageContent::resolvedForPublic()->success_message);
    }

    public function anakAsuh()
    {
        $anak = $this->publicAnakAsuhCollection();

        $page = AnakAsuhPageContent::resolvedForPublic();

        return view('pages.anak-asuh', compact('anak', 'page'));
    }

    /**
     * Anak asuh untuk tampilan publik: hanya yang punya nama panggilan terisi, urut abjad panggilan.
     */
    protected function publicAnakAsuhCollection(): Collection
    {
        if (! Schema::hasTable('anak_asuh')) {
            return collect();
        }

        return AnakAsuh::query()
            ->get()
            ->filter(fn (AnakAsuh $row) => filled(trim((string) ($row->nama_panggilan ?? ''))))
            ->sortBy(fn (AnakAsuh $row) => mb_strtolower(trim($row->nama_panggilan)))
            ->values();
    }

    public function jadwalKegiatanAnak()
    {
        return redirect()->route('program', [], 301);
    }
}
