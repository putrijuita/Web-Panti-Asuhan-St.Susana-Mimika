@extends('admin.layouts.app')

@section('title', 'Kunjungan')
@section('page-title', 'Manajemen Kunjungan')
@section('page-subtitle', 'Daftar permintaan kunjungan ke panti')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.kunjungan.index') }}">
            <div class="filter-bar">
                <div class="form-group">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama, email, instansi..." value="{{ request('search') }}">
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
                    <a href="{{ route('admin.kunjungan.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-calendar-check" style="color:#0d9488;margin-right:8px;"></i>
            {{ $kunjungan->total() }} Kunjungan
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pemohon</th>
                    <th>Instansi</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Didaftarkan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kunjungan as $k)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $kunjungan->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="font-weight:600;font-size:13.5px;">{{ $k->nama }}</div>
                        <div style="font-size:12px;color:#64748b;">{{ $k->email }}</div>
                        @if($k->telepon)
                            <div style="font-size:11.5px;color:#94a3b8;">{{ $k->telepon }}</div>
                        @endif
                    </td>
                    <td style="font-size:13px;">{{ $k->instansi ?? '-' }}</td>
                    <td style="font-size:13px;font-weight:600;">
                        {{ \Carbon\Carbon::parse($k->tanggal_kunjungan)->format('d M Y') }}
                    </td>
                    <td style="font-size:12.5px;color:#64748b;max-width:200px;">
                        {{ Str::limit($k->keperluan, 60) }}
                    </td>
                    <td>
                        @php
                            $kClass = match($k->status) {
                                'approved' => 'badge-success',
                                'pending' => 'badge-warning',
                                'rejected' => 'badge-danger',
                                'completed' => 'badge-info',
                                default => 'badge-gray'
                            };
                        @endphp
                        <span class="badge {{ $kClass }}">{{ ucfirst($k->status) }}</span>
                    </td>
                    <td style="font-size:12.5px;color:#64748b;">
                        {{ $k->created_at->format('d M Y') }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.kunjungan.show', $k) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.kunjungan.destroy', $k) }}" onsubmit="return confirm('Hapus data ini?')">
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
                        Belum ada data kunjungan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kunjungan->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $kunjungan->firstItem() }}–{{ $kunjungan->lastItem() }} dari {{ $kunjungan->total() }} data</span>
        {{ $kunjungan->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
