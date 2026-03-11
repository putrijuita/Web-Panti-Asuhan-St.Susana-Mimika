@extends('admin.layouts.app')

@section('title', 'Donasi Jasa')
@section('page-title', 'Donasi Jasa')
@section('page-subtitle', 'Daftar relawan dan donasi jasa')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.jasa.index') }}">
            <div class="filter-bar">
                <div class="form-group">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama, email, jenis jasa..." value="{{ request('search') }}">
                </div>
                <div class="form-group" style="max-width:180px;">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Disetujui</option>
                        <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Ditolak</option>
                        <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Selesai</option>
                    </select>
                </div>
                <div style="display:flex;gap:8px;align-items:flex-end;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <a href="{{ route('admin.jasa.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-hands-helping" style="color:#7c3aed;margin-right:8px;"></i>
            {{ $jasa->total() }} Donasi Jasa
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Relawan</th>
                    <th>Jenis Jasa</th>
                    <th>Instansi</th>
                    <th>Tanggal Mulai</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jasa as $j)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $jasa->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="font-weight:600;font-size:13.5px;">{{ $j->nama }}</div>
                        <div style="font-size:12px;color:#64748b;">{{ $j->email }}</div>
                        @if($j->telepon)
                            <div style="font-size:11.5px;color:#94a3b8;">{{ $j->telepon }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-purple">{{ ucfirst($j->jenis_jasa) }}</span>
                    </td>
                    <td style="font-size:13px;">{{ $j->instansi ?? '-' }}</td>
                    <td style="font-size:13px;font-weight:600;">
                        {{ \Carbon\Carbon::parse($j->tanggal_mulai)->format('d M Y') }}
                    </td>
                    <td style="font-size:13px;">{{ $j->durasi }}</td>
                    <td>
                        @php
                            $jClass = match($j->status) {
                                'approved' => 'badge-success',
                                'pending' => 'badge-warning',
                                'rejected' => 'badge-danger',
                                'completed' => 'badge-info',
                                default => 'badge-gray'
                            };
                        @endphp
                        <span class="badge {{ $jClass }}">{{ ucfirst($j->status) }}</span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.jasa.show', $j) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.jasa.destroy', $j) }}" onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada data donasi jasa
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jasa->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $jasa->firstItem() }}–{{ $jasa->lastItem() }} dari {{ $jasa->total() }} data</span>
        {{ $jasa->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
