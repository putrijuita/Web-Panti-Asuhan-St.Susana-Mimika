@extends('admin.layouts.app')

@section('title', 'Edit Admin')
@section('page-title', 'Edit Admin')
@section('page-subtitle', 'Perbarui data akun admin')

@section('content')
<div style="max-width:560px">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-user-edit" style="margin-right:6px;color:var(--primary)"></i>Edit: {{ $admin->name }}</span>
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

            <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email <span style="color:var(--danger)">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                    <small style="color:var(--gray-500);font-size:12px;margin-top:4px;display:block">
                        Minimal 4 karakter. Kosongkan jika tidak ingin mengubah password.
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                </div>

                <div class="form-group">
                    <label class="form-label">Role <span style="color:var(--danger)">*</span></label>
                    <select name="role" class="form-control" required
                        {{ Auth::guard('admin')->id() === $admin->id ? 'disabled' : '' }}>
                        <option value="admin" {{ old('role', $admin->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ old('role', $admin->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @if(Auth::guard('admin')->id() === $admin->id)
                        <input type="hidden" name="role" value="{{ $admin->role }}">
                        <small style="color:var(--warning);font-size:12px;margin-top:4px;display:block">
                            <i class="fas fa-lock"></i> Anda tidak dapat mengubah role akun Anda sendiri.
                        </small>
                    @else
                        <small style="color:var(--gray-500);font-size:12px;margin-top:4px;display:block">
                            Super Admin dapat mengelola akun admin lain.
                        </small>
                    @endif
                </div>

                <div style="display:flex;gap:10px;margin-top:8px">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Perbarui Admin
                    </button>
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
