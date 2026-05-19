@extends('admin.auth.layouts.guest')

@section('pageTitle', 'Atur ulang kata sandi — Panel Admin')

@section('cardIcon', 'fa-key')
@section('cardTitle', 'Kata sandi baru')
@section('cardSubtitle', 'Buat kata sandi baru untuk akun admin Anda.')

@section('content')
    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ old('email', $email) }}">
        <div class="email-locked">
            <label>Email admin</label>
            <p class="email-locked-value">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <span>{{ old('email', $email) }}</span>
            </p>
        </div>
        <div class="form-group">
            <label for="password">Kata sandi baru</label>
            <div class="input-wrap">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Minimal 4 karakter" required autocomplete="new-password" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi kata sandi</label>
            <div class="input-wrap">
                <i class="fas fa-lock"></i>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi baru" required autocomplete="new-password">
            </div>
        </div>
        <button type="submit" class="btn-login">
            <i class="fas fa-check"></i>
            Simpan kata sandi baru
        </button>
    </form>
@endsection

@section('footer')
    <a href="{{ route('admin.login') }}">
        <i class="fas fa-arrow-left"></i>
        Kembali ke halaman login
    </a>
@endsection
