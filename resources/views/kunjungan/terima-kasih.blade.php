@extends('layouts.app')

@section('title', 'Terima Kasih - Panti Asuhan St. Susana Mimika')

@section('content')
<div class="card" style="text-align: center; padding: 4rem 2rem; max-width: 500px; margin: 0 auto;">
    <div style="font-size: 4rem; margin-bottom: 1rem;">✅</div>
    <h1 style="margin-bottom: 1rem; color: #2E86AB;">Permohonan Diterima!</h1>
    <p style="color: #64748B; margin-bottom: 2rem;">
        Permohonan kunjungan Anda telah kami terima. Tim kami akan menghubungi Anda untuk konfirmasi.
    </p>
    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection
