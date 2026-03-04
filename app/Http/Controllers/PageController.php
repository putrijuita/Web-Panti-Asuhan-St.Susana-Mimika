<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tentang()
    {
        return view('pages.tentang');
    }

    public function program()
    {
        return view('pages.program');
    }

    public function galeri()
    {
        return view('pages.galeri');
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

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
