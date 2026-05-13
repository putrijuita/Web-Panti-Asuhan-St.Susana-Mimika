@extends('admin.layouts.app')

@section('title', 'Pesan kontak')
@section('page-title', 'Pesan dari halaman Kontak')
@section('page-subtitle', 'Pesan yang dikirim pengunjung lewat form di /kontak')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.kontak-pesan.index') }}">
            <div class="filter-bar">
                <div class="form-group">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama, email, subjek, isi pesan…" value="{{ request('search') }}">
                </div>
                <div class="filter-bar-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    <a href="{{ route('admin.kontak-pesan.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-envelope-open-text" style="color:#0d9488;margin-right:8px;"></i>
            {{ $pesan->total() }} pesan
        </span>
        <a href="{{ route('admin.kontak-page.edit') }}" class="btn btn-secondary btn-sm" style="font-size:12px;">
            <i class="fas fa-pen"></i> Ubah halaman /kontak
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Ringkasan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesan as $p)
                <tr style="{{ $p->read_at ? '' : 'background:#f0fdf4;' }}">
                    <td style="color:#94a3b8;font-size:12px;">{{ $pesan->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="font-weight:600;font-size:13.5px;">{{ $p->nama }}</div>
                        <div style="font-size:12px;color:#64748b;">{{ $p->email }}</div>
                        @if(!$p->read_at)
                            <span class="badge badge-warning" style="margin-top:4px;font-size:10px;">Baru</span>
                        @endif
                    </td>
                    <td style="font-size:13px;max-width:180px;">{{ \Illuminate\Support\Str::limit($p->subjek, 80) }}</td>
                    <td style="font-size:12.5px;color:#64748b;max-width:260px;">{{ \Illuminate\Support\Str::limit($p->pesan, 90) }}</td>
                    <td style="font-size:12px;">
                        @if($p->replied_at)
                            <span class="badge badge-success">Dibalas</span>
                        @else
                            <span class="badge badge-gray">Belum dibalas</span>
                        @endif
                    </td>
                    <td style="font-size:12.5px;color:#64748b;">
                        {{ $p->created_at->format('d M Y, H:i') }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <a href="{{ route('admin.kontak-pesan.show', $p) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i> Baca
                            </a>
                            <form method="POST" action="{{ route('admin.kontak-pesan.destroy', $p) }}" style="display:inline;" onsubmit="return confirm('Hapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada pesan dari form kontak
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pesan->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $pesan->firstItem() }}–{{ $pesan->lastItem() }} dari {{ $pesan->total() }} data</span>
        {{ $pesan->links('admin.partials.pagination') }}
    </div>
    @endif
</div>
@endsection
