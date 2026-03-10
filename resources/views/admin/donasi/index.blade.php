@extends('admin.layouts.app')

@section('title', 'Donasi Uang')
@section('page-title', 'Donasi Uang')
@section('page-subtitle', 'Daftar semua donasi keuangan')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.donasi.index') }}">
            <div class="filter-bar">
                <div class="form-group">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama, email, order ID..." value="{{ request('search') }}">
                </div>
                <div class="form-group" style="max-width:180px;">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                        <option value="settlement" {{ request('status')=='settlement'?'selected':'' }}>Settlement</option>
                        <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
                        <option value="cancel" {{ request('status')=='cancel'?'selected':'' }}>Cancel</option>
                        <option value="expire" {{ request('status')=='expire'?'selected':'' }}>Expire</option>
                        <option value="failure" {{ request('status')=='failure'?'selected':'' }}>Failure</option>
                    </select>
                </div>
                <div style="display:flex;gap:8px;align-items:flex-end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.donasi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-hand-holding-heart" style="color:#3b82f6;margin-right:8px;"></i>
            {{ $donasi->total() }} Donasi
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Donatur</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donasi as $d)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $donasi->firstItem() + $loop->index }}</td>
                    <td>
                        <code style="font-size:11.5px;background:#f1f5f9;padding:2px 6px;border-radius:4px;">
                            {{ $d->order_id ?? '-' }}
                        </code>
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:13.5px;">{{ $d->nama }}</div>
                        <div style="font-size:12px;color:#64748b;">{{ $d->email }}</div>
                        @if($d->telepon)
                            <div style="font-size:11.5px;color:#94a3b8;">{{ $d->telepon }}</div>
                        @endif
                    </td>
                    <td style="font-weight:700;color:#059669;">
                        Rp {{ number_format($d->nominal, 0, ',', '.') }}
                    </td>
                    <td>
                        @if($d->payment_type)
                            <span class="badge badge-info">{{ str_replace('_',' ',ucfirst($d->payment_type)) }}</span>
                        @else
                            <span style="color:#94a3b8;font-size:12px;">-</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $statusClass = match($d->status) {
                                'settlement','completed' => 'badge-success',
                                'pending','capture' => 'badge-warning',
                                'cancel','expire','failure','deny' => 'badge-danger',
                                default => 'badge-gray'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ ucfirst($d->status) }}</span>
                    </td>
                    <td style="font-size:12.5px;color:#64748b;">
                        {{ $d->created_at->format('d M Y H:i') }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.donasi.show', $d) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.donasi.destroy', $d) }}" onsubmit="return confirm('Hapus donasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada data donasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($donasi->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $donasi->firstItem() }}–{{ $donasi->lastItem() }} dari {{ $donasi->total() }} data</span>
        {{ $donasi->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
