@extends('admin.layouts.app')

@section('title', 'Profil saya')
@section('page-title', 'Profil saya')
@section('page-subtitle', 'Berlaku untuk semua akun admin dan super admin: ubah nama, foto profil, dan password. Email tidak dapat diubah dari sini.')

@section('content')
<div style="max-width:640px;width:100%;min-width:0">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-id-badge" style="margin-right:6px;color:var(--primary)"></i>Pengaturan akun</span>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin:0;padding-left:16px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Foto profil</label>
                    @include('admin.partials.cms-current-file', [
                        'url' => $admin->avatarUrl(),
                        'path' => $admin->avatar,
                        'maxHeight' => '120px',
                        'emptyText' => 'Belum ada foto profil — tampil ikon bawaan.',
                    ])
                    @if($admin->avatarUrl())
                        <p style="margin:-4px 0 10px;font-size:12px;">
                            <button type="button" class="js-admin-avatar-lightbox btn btn-secondary btn-sm"
                                data-src="{{ $admin->avatarUrl() }}"
                                data-caption="{{ $admin->name }}">
                                <i class="fas fa-search-plus"></i> Lihat foto lebih besar
                            </button>
                        </p>
                    @endif
                    <input type="file" name="avatar" class="form-control" accept="image/jpeg,image/png,image/webp,image/gif">
                    <small style="color:var(--gray-500);font-size:12px;margin-top:4px;display:block">
                        JPG, PNG, WebP, atau GIF. Maks. 1 GB.
                    </small>
                    @if($admin->avatar)
                    <label style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;color:var(--gray-600);cursor:pointer">
                        <input type="checkbox" name="remove_avatar" value="1">
                        Hapus foto profil
                    </label>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">Nama <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $admin->email }}" readonly disabled style="opacity:0.85;cursor:not-allowed;background:var(--gray-100)">
                    <small style="color:var(--gray-500);font-size:12px;margin-top:4px;display:block">
                        Email digunakan untuk login dan tidak dapat diubah dari sini.
                    </small>
                </div>

                <hr style="border:none;border-top:1px solid var(--gray-200);margin:20px 0">

                <p style="font-size:13px;font-weight:600;color:var(--gray-700);margin-bottom:12px">Ubah password</p>

                <div class="form-group">
                    <label class="form-label">Password saat ini</label>
                    <input type="password" name="current_password" class="form-control" autocomplete="current-password" placeholder="Wajib jika mengisi password baru">
                </div>

                <div class="form-group">
                    <label class="form-label">Password baru</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Kosongkan jika tidak diubah">
                    <small style="color:var(--gray-500);font-size:12px;margin-top:4px;display:block">Minimal 8 karakter.</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi password baru</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" placeholder="Ulangi password baru">
                </div>

                <div style="display:flex;gap:10px;margin-top:8px;flex-wrap:wrap">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan perubahan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
