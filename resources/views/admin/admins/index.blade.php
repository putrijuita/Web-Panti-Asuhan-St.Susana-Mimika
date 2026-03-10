@extends('admin.layouts.app')

@section('title', 'Manajemen Admin')
@section('page-title', 'Manajemen Admin')
@section('page-subtitle', 'Kelola akun admin dan super admin')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-users-cog" style="margin-right:6px;color:var(--primary)"></i>Daftar Admin</span>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Admin
        </a>
    </div>

    {{-- Filter --}}
    <div class="card-body" style="padding-bottom:0">
        <form method="GET" class="filter-bar">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ $search }}">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Cari
            </button>
            @if($search)
                <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap" style="margin-top:16px">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                <tr>
                    <td style="color:var(--gray-500)">{{ $admins->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div style="width:32px;height:32px;background:{{ $admin->isSuperAdmin() ? '#dbeafe' : '#f1f5f9' }};border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;color:{{ $admin->isSuperAdmin() ? 'var(--primary)' : 'var(--gray-500)' }};flex-shrink:0">
                                <i class="fas fa-user"></i>
                            </div>
                            <strong>{{ $admin->name }}</strong>
                        </div>
                    </td>
                    <td style="color:var(--gray-600)">{{ $admin->email }}</td>
                    <td>
                        @if($admin->isSuperAdmin())
                            <span class="badge badge-info"><i class="fas fa-crown" style="font-size:10px"></i> Super Admin</span>
                        @else
                            <span class="badge badge-gray">Admin</span>
                        @endif
                    </td>
                    <td style="color:var(--gray-500);font-size:12.5px">{{ $admin->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap">
                            <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @if(Auth::guard('admin')->id() !== $admin->id)
                            <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}"
                                  onsubmit="return confirm('Hapus admin {{ $admin->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:32px;color:var(--gray-500)">
                        <i class="fas fa-users" style="font-size:32px;margin-bottom:8px;display:block;opacity:.4"></i>
                        Tidak ada admin ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($admins->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $admins->firstItem() }}–{{ $admins->lastItem() }} dari {{ $admins->total() }} admin</span>
        {{ $admins->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
