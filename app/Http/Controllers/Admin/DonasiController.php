<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::query()->latest();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('nama', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('order_id', 'like', "%{$q}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $donasi = $query->paginate(15)->withQueryString();
        return view('admin.donasi.index', compact('donasi'));
    }

    public function show(Donasi $donasi)
    {
        return view('admin.donasi.show', compact('donasi'));
    }

    public function status(Request $request, Donasi $donasi)
    {
        $request->validate(['status' => 'required|in:pending,settlement,completed,cancel,expire,failure,deny']);
        $donasi->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status donasi diperbarui.');
    }

    public function destroy(Donasi $donasi)
    {
        $donasi->delete();
        return redirect()->route('admin.donasi.index')->with('success', 'Donasi dihapus.');
    }
}
