@extends('admin.layouts.app')

@section('title', 'Detail Donasi Jasa')
@section('page-title', 'Detail Donasi Jasa')
@section('page-subtitle', 'Informasi lengkap donasi jasa / relawan')

@section('content')
<div style="max-width:800px;">
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
            <div style="margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;display:flex;gap:10px;flex-wrap:wrap;">
                <form method="POST" action="{{ route('admin.jasa.status', $jasa) }}">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Terima
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.jasa.status', $jasa) }}">
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
            <span class="card-title"><i class="fas fa-envelope" style="color:#7c3aed;margin-right:8px;"></i>Kirim Respons ke Relawan</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.jasa.send-response', $jasa) }}" onsubmit="return confirm('Kirim respons ini ke email {{ $jasa->email }}?');">
                @csrf
                <div class="form-group">
                    <label class="form-label">Respons</label>
                    <textarea name="response" class="form-control" rows="4" placeholder="Tulis respons atau pesan untuk relawan (akan dikirim ke email terdaftar)..." required>{{ old('response') }}</textarea>
                    @error('response')<span class="text-danger" style="font-size:12px;">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim respons ke email yang terdaftar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
