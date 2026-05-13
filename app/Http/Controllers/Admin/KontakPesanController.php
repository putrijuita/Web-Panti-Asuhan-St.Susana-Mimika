<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KontakPesanBalasan;
use App\Models\KontakPesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class KontakPesanController extends Controller
{
    public function index(Request $request)
    {
        if (! Schema::hasTable('kontak_pesan')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel pesan kontak belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $query = KontakPesan::query()->latest();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('nama', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('subjek', 'like', "%{$q}%")
                    ->orWhere('pesan', 'like', "%{$q}%");
            });
        }

        $pesan = $query->paginate(15)->withQueryString();

        return view('admin.kontak-pesan.index', compact('pesan'));
    }

    public function show(KontakPesan $kontakPesan)
    {
        if ($kontakPesan->read_at === null) {
            $kontakPesan->update(['read_at' => now()]);
        }

        return view('admin.kontak-pesan.show', compact('kontakPesan'));
    }

    public function destroy(KontakPesan $kontakPesan)
    {
        $kontakPesan->delete();

        return redirect()->route('admin.kontak-pesan.index')->with('success', 'Pesan dihapus.');
    }

    public function balas(Request $request, KontakPesan $kontakPesan)
    {
        $request->validate([
            'balasan' => ['required', 'string', 'max:10000'],
        ]);

        try {
            Mail::to($kontakPesan->email)->send(new KontakPesanBalasan($kontakPesan, $request->balasan));
        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()
                ->with('error', $this->mailFailureUserMessage($e, 'Gagal mengirim balasan ke pengirim.'))
                ->withInput();
        }

        $kontakPesan->update(['replied_at' => now()]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim ke '.$kontakPesan->email.'.');
    }

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
