@extends('admin.layouts.app')

@section('title', 'Detail Kunjungan')
@section('page-title', 'Detail Kunjungan')
@section('page-subtitle', 'Informasi lengkap permintaan kunjungan')

@section('content')
<div style="display:flex;gap:20px;flex-wrap:wrap;">
    <div style="flex:2;min-width:280px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fas fa-calendar-check" style="color:#0d9488;margin-right:8px;"></i>Informasi Kunjungan</span>
                <a href="{{ route('admin.kunjungan.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table style="width:100%;">
                    @php $tdLeft = 'padding:10px 0;width:40%;color:#64748b;font-size:13px;vertical-align:top;'; $tdRight = 'padding:10px 0;font-size:13.5px;'; $border = 'border-top:1px solid #f1f5f9;'; @endphp
                    <tr>
                        <td style="{{ $tdLeft }}">Nama</td>
                        <td style="{{ $tdRight }}font-weight:600;">{{ $kunjungan->nama }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Email</td>
                        <td style="{{ $tdRight }}{{ $border }}">{{ $kunjungan->email }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Telepon</td>
                        <td style="{{ $tdRight }}{{ $border }}">{{ $kunjungan->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Instansi</td>
                        <td style="{{ $tdRight }}{{ $border }}">{{ $kunjungan->instansi ?? 'Perorangan' }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Tanggal Kunjungan</td>
                        <td style="{{ $tdRight }}{{ $border }}font-weight:700;color:#0d9488;">
                            {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Keperluan</td>
                        <td style="{{ $tdRight }}{{ $border }}">{{ $kunjungan->keperluan }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Catatan</td>
                        <td style="{{ $tdRight }}{{ $border }}">{{ $kunjungan->catatan ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td style="{{ $tdLeft }}{{ $border }}">Didaftarkan</td>
                        <td style="{{ $tdRight }}{{ $border }}">{{ $kunjungan->created_at->format('d F Y, H:i') }}</td>
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
                    $kClass = match($kunjungan->status) {
                        'approved' => 'badge-success',
                        'pending' => 'badge-warning',
                        'rejected' => 'badge-danger',
                        'completed' => 'badge-info',
                        default => 'badge-gray'
                    };
                @endphp
                <div style="text-align:center;margin-bottom:20px;">
                    <span class="badge {{ $kClass }}" style="font-size:14px;padding:6px 16px;">{{ ucfirst($kunjungan->status) }}</span>
                </div>
                <form method="POST" action="{{ route('admin.kunjungan.status', $kunjungan) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Ubah Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $kunjungan->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="approved" {{ $kunjungan->status=='approved'?'selected':'' }}>Disetujui</option>
                            <option value="rejected" {{ $kunjungan->status=='rejected'?'selected':'' }}>Ditolak</option>
                            <option value="completed" {{ $kunjungan->status=='completed'?'selected':'' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-save"></i> Simpan Status
                    </button>
                </form>
                <hr style="border:none;border-top:1px solid #f1f5f9;margin:16px 0;">
                <form method="POST" action="{{ route('admin.kunjungan.destroy', $kunjungan) }}" onsubmit="return confirm('Hapus data ini secara permanen?')">
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
