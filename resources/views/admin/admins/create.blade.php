@extends('admin.layouts.app')

@section('title', 'Tambah Admin')
@section('page-title', 'Tambah Admin Baru')
@section('page-subtitle', 'Buat akun admin atau super admin baru')

@section('content')
<div style="max-width:560px">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-user-plus" style="margin-right:6px;color:var(--primary)"></i>Form Tambah Admin</span>
            <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
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

            <form method="POST" action="{{ route('admin.admins.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso">
                </div>

                <div class="form-group">
                    <label class="form-label">Email <span style="color:var(--danger)">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="contoh@email.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" name="password" class="form-control" required placeholder="Minimal 4 karakter">
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                </div>

                <div class="form-group">
                    <label class="form-label">Role <span style="color:var(--danger)">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    <small style="color:var(--gray-500);font-size:12px;margin-top:4px;display:block">
                        Super Admin dapat mengelola akun admin lain.
                    </small>
                </div>

                <div style="display:flex;gap:10px;margin-top:8px">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Admin
                    </button>
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
