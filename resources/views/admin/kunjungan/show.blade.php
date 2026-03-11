@extends('admin.layouts.app')

@section('title', 'Detail Kunjungan')
@section('page-title', 'Detail Kunjungan')
@section('page-subtitle', 'Informasi lengkap permintaan kunjungan')

@section('content')
<div style="max-width:720px;">
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
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                <form method="POST" action="{{ route('admin.kunjungan.status', $kunjungan) }}">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Terima
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.kunjungan.status', $kunjungan) }}">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:20px;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-reply" style="color:#0d9488;margin-right:8px;"></i>Kirim Respon ke Pemohon</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.kunjungan.respon', $kunjungan) }}" onsubmit="return confirm('Kirim respon ini ke email {{ $kunjungan->email }}?');">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="respon">Respon</label>
                    <textarea name="respon" id="respon" class="form-control" rows="4" placeholder="Tulis pesan respon untuk pemohon kunjungan..." required>{{ old('respon') }}</textarea>
                    @error('respon')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim respon ke email terdaftar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
