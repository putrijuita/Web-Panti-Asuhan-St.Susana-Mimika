@extends('layouts.app')

@section('title', $kunjunganPage->thanks_meta_title ?? 'Terima Kasih')

@section('content')
<div class="card" style="text-align: center; padding: 4rem 2rem; max-width: 500px; margin: 0 auto;">
    <div style="font-size: 4rem; margin-bottom: 1rem;">{{ $kunjunganPage->thanks_emoji }}</div>
    <h1 style="margin-bottom: 1rem; color: #2E86AB;">{{ $kunjunganPage->thanks_title }}</h1>
    <p style="color: var(--teks-muted); margin-bottom: 2rem;">
        {{ $kunjunganPage->thanks_body }}
    </p>
    <a href="{{ route('home') }}" class="btn btn-primary">{{ $kunjunganPage->thanks_btn_text }}</a>
</div>
@endsection
