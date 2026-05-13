<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KunjunganResponNotification;
use App\Mail\KunjunganStatusNotification;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

            return redirect()->back()->with('error', $this->mailFailureUserMessage($e, 'Gagal mengirim email ke pemohon.'));
        }

        return redirect()->back()->with('success', 'Email informasi kunjungan berhasil dikirim ke pemohon.');
    }

    public function sendRespon(Request $request, Kunjungan $kunjungan)
    {
        $request->validate(['respon' => 'required|string|max:10000']);

        if (!$kunjungan->email) {
            return redirect()->back()->with('error', 'Email tidak tersedia untuk permohonan kunjungan ini.');
        }

        try {
            Mail::to($kunjungan->email)->send(new KunjunganResponNotification($kunjungan, $request->respon));
        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()
                ->with('error', $this->mailFailureUserMessage($e, 'Gagal mengirim respon ke pemohon.'))
                ->withInput();
        }

        return redirect()->back()->with('success', 'Respon berhasil dikirim ke email terdaftar.');
    }

    /**
     * Pesan singkat untuk admin; detail panjang SMTP hanya saat APP_DEBUG=true (dibatasi).
     */
    private function mailFailureUserMessage(\Throwable $e, string $lead): string
    {
        $raw = $e->getMessage();
        $smtpAuthHint = $this->smtpLooksLikeBadCredentials($raw)
            ? ' Penyebab umum: sandi SMTP salah atau Gmail memerlukan Sandi aplikasi (App Password) di file .env hosting, bukan sandi login biasa.'
            : '';

        $out = $lead.$smtpAuthHint.' Silakan coba lagi setelah pengaturan diperbaiki.';

        if (config('app.debug')) {
            $compact = Str::limit(preg_replace('/\s+/u', ' ', $raw), 450, '…');

            return $out.' [Debug: '.$compact.']';
        }

        return $out;
    }

    private function smtpLooksLikeBadCredentials(string $message): bool
    {
        return str_contains($message, '535')
            || str_contains($message, 'BadCredentials')
            || str_contains($message, 'Username and Password not accepted')
            || str_contains($message, 'Failed to authenticate on SMTP');
    }
}
