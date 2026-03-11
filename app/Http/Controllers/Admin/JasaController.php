<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonasiJasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JasaController extends Controller
{
    public function index(Request $request)
    {
        $query = DonasiJasa::query()->latest();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('nama', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('jenis_jasa', 'like', "%{$q}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jasa = $query->paginate(15)->withQueryString();
        return view('admin.jasa.index', compact('jasa'));
    }

    public function show(DonasiJasa $jasa)
    {
        return view('admin.jasa.show', compact('jasa'));
    }

    public function status(Request $request, DonasiJasa $jasa)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected,completed']);
        $jasa->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status donasi jasa diperbarui.');
    }

    public function sendResponse(Request $request, DonasiJasa $jasa)
    {
        $request->validate(['response' => 'required|string|max:10000']);

        if (! $jasa->email) {
            return redirect()->back()->with('error', 'Email tidak tersedia untuk donasi jasa ini.');
        }

        try {
            Mail::raw($request->response, function ($message) use ($jasa) {
                $message->to($jasa->email)
                    ->subject('📬 Respons Donasi Jasa – Panti Asuhan Santa Susana Timika');
            });
        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Gagal mengirim respons ke email terdaftar. Silakan coba lagi.');
        }

        return redirect()->back()->with('success', 'Respons berhasil dikirim ke email terdaftar.');
    }

    public function destroy(DonasiJasa $jasa)
    {
        $jasa->delete();
        return redirect()->route('admin.jasa.index')->with('success', 'Data donasi jasa dihapus.');
    }
}
