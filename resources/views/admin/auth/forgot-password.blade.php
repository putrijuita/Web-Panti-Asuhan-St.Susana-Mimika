@extends('admin.auth.layouts.guest')

@section('pageTitle', 'Lupa kata sandi — Panel Admin')

@section('cardIcon', 'fa-envelope-open-text')
@section('cardTitle', 'Lupa kata sandi?')
@section('cardSubtitle', 'Masukkan email admin terdaftar. Kami akan mengirim tautan reset ke kotak masuk Anda.')

@section('content')
    <p class="form-hint">Pastikan email yang Anda masukkan sama dengan yang digunakan saat akun admin dibuat.</p>
    <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email admin</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@contoh.com" required autocomplete="email" autofocus>
            </div>
        </div>
        <button type="submit" class="btn-login">
            <i class="fas fa-paper-plane"></i>
            Kirim tautan reset
        </button>
    </form>
@endsection

@section('footer')
    <a href="{{ route('admin.login') }}">
        <i class="fas fa-arrow-left"></i>
        Kembali ke halaman login
    </a>
@endsection
