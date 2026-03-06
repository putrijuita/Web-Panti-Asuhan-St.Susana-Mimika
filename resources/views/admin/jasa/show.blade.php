@extends('admin.layouts.app')

@section('title', 'Detail Donasi Jasa')
@section('page-title', 'Detail Donasi Jasa')
@section('page-subtitle', 'Informasi lengkap donasi jasa / relawan')

@section('content')
<div style="display:flex;gap:20px;flex-wrap:wrap;">
    <div style="flex:2;min-width:280px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fas fa-hands-helping" style="color:#7c3aed;margin-right:8px;"></i>Informasi Donasi Jasa</span>
                <a href="{{ route('admin.jasa.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @php $tdL = 'padding:10px 0;width:40%;color:#64748b;font-size:13px;vertical-align:top;'; $tdR = 'padding:10px 0;font-size:13.5px;'; $b = 'border-top:1px solid #f1f5f9;'; @endphp
                <table style="width:100%;">
                    <tr>
                        <td style="{{ $tdL }}">Nama</td>
                        <td style="{{ $tdR }}font-weight:600;">{{ $jasa->nama }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Email</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->email }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Telepon</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Instansi</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->instansi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Jenis Jasa</td>
                        <td style="{{ $tdR }}{{ $b }}">
                            <span class="badge badge-purple" style="font-size:13px;padding:4px 12px;">{{ ucfirst($jasa->jenis_jasa) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Keahlian</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->keahlian }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Tanggal Mulai</td>
                        <td style="{{ $tdR }}{{ $b }}font-weight:700;color:#7c3aed;">
                            {{ \Carbon\Carbon::parse($jasa->tanggal_mulai)->format('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Durasi</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->durasi }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Deskripsi</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Catatan</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->catatan ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdL }}{{ $b }}">Didaftarkan</td>
                        <td style="{{ $tdR }}{{ $b }}">{{ $jasa->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div style="flex:1;min-width:240px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fas fa-edit" style="color:#8b5cf6;margin-right:8px;"></i>Status</span>
            </div>
            <div class="card-body">
                @php
                    $jClass = match($jasa->status) {
                        'approved' => 'badge-success',
                        'pending' => 'badge-warning',
                        'rejected' => 'badge-danger',
                        'completed' => 'badge-info',
                        default => 'badge-gray'
                    };
                @endphp
                <div style="text-align:center;margin-bottom:20px;">
                    <span class="badge {{ $jClass }}" style="font-size:14px;padding:6px 16px;">{{ ucfirst($jasa->status) }}</span>
                </div>
                <form method="POST" action="{{ route('admin.jasa.status', $jasa) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Ubah Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $jasa->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="approved" {{ $jasa->status=='approved'?'selected':'' }}>Disetujui</option>
                            <option value="rejected" {{ $jasa->status=='rejected'?'selected':'' }}>Ditolak</option>
                            <option value="completed" {{ $jasa->status=='completed'?'selected':'' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-save"></i> Simpan Status
                    </button>
                </form>
                <hr style="border:none;border-top:1px solid #f1f5f9;margin:16px 0;">
                <form method="POST" action="{{ route('admin.jasa.destroy', $jasa) }}" onsubmit="return confirm('Hapus data ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;">
                        <i class="fas fa-trash"></i> Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
