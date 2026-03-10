<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KunjunganStatusNotification;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Kunjungan::query()->latest();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('nama', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('instansi', 'like', "%{$q}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $kunjungan = $query->paginate(15)->withQueryString();
        return view('admin.kunjungan.index', compact('kunjungan'));
    }

    public function show(Kunjungan $kunjungan)
    {
        return view('admin.kunjungan.show', compact('kunjungan'));
    }

    public function status(Request $request, Kunjungan $kunjungan)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected,completed']);
        $kunjungan->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status kunjungan diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->route('admin.kunjungan.index')->with('success', 'Data kunjungan dihapus.');
    }

    public function sendEmail(Kunjungan $kunjungan)
    {
        if (!$kunjungan->email) {
            return redirect()->back()->with('error', 'Email tidak tersedia untuk permohonan kunjungan ini.');
        }

        try {
            Mail::to($kunjungan->email)->send(new KunjunganStatusNotification($kunjungan));
        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Gagal mengirim email ke pemohon. Silakan coba lagi.');
        }

        return redirect()->back()->with('success', 'Email informasi kunjungan berhasil dikirim ke pemohon.');
    }
}
