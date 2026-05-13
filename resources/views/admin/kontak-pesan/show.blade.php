@extends('admin.layouts.app')

@section('title', 'Detail pesan kontak')
@section('page-title', 'Detail pesan')
@section('page-subtitle', 'Dari form halaman Kontak')

@section('content')
<div style="max-width:720px;width:100%;min-width:0;">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-envelope" style="color:#0d9488;margin-right:8px;"></i>Pesan</span>
            <a href="{{ route('admin.kontak-pesan.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            @php $tdLeft = 'padding:10px 0;width:34%;color:#64748b;font-size:13px;vertical-align:top;'; $tdRight = 'padding:10px 0;font-size:13.5px;'; $border = 'border-top:1px solid #f1f5f9;'; @endphp
            <table style="width:100%;">
                <tr>
                    <td style="{{ $tdLeft }}">Nama</td>
                    <td style="{{ $tdRight }}font-weight:600;">{{ $kontakPesan->nama }}</td>
                </tr>
                <tr>
                    <td style="{{ $tdLeft }}{{ $border }}">Email</td>
                    <td style="{{ $tdRight }}{{ $border }}">
                        <a href="mailto:{{ $kontakPesan->email }}">{{ $kontakPesan->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="{{ $tdLeft }}{{ $border }}">Subjek</td>
                    <td style="{{ $tdRight }}{{ $border }}font-weight:600;">{{ $kontakPesan->subjek }}</td>
                </tr>
                <tr>
                    <td style="{{ $tdLeft }}{{ $border }}">Pesan</td>
                    <td style="{{ $tdRight }}{{ $border }}white-space:pre-wrap;line-height:1.55;">{{ $kontakPesan->pesan }}</td>
                </tr>
                <tr>
                    <td style="{{ $tdLeft }}{{ $border }}">Dikirim</td>
                    <td style="{{ $tdRight }}{{ $border }}">{{ $kontakPesan->created_at->format('d F Y, H:i') }}</td>
                </tr>
                @if($kontakPesan->read_at)
                <tr>
                    <td style="{{ $tdLeft }}{{ $border }}">Dibaca</td>
                    <td style="{{ $tdRight }}{{ $border }}">{{ $kontakPesan->read_at->format('d F Y, H:i') }}</td>
                </tr>
                @endif
                @if($kontakPesan->replied_at)
                <tr>
                    <td style="{{ $tdLeft }}{{ $border }}">Balasan terkirim</td>
                    <td style="{{ $tdRight }}{{ $border }}">{{ $kontakPesan->replied_at->format('d F Y, H:i') }}</td>
                </tr>
                @endif
            </table>
            <div style="margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                <form method="POST" action="{{ route('admin.kontak-pesan.destroy', $kontakPesan) }}" onsubmit="return confirm('Hapus pesan ini?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus pesan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:20px;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-reply" style="color:#0d9488;margin-right:8px;"></i>Kirim balasan ke pengirim</span>
        </div>
        <div class="card-body">
            <p style="font-size:13px;color:#64748b;margin-bottom:16px;line-height:1.6;">
                Balasan dikirim ke <strong>{{ $kontakPesan->email }}</strong> dari alamat email situs (pengaturan <code style="font-size:12px;">MAIL_*</code> di <code style="font-size:12px;">.env</code>).
            </p>
            <form method="POST" action="{{ route('admin.kontak-pesan.balas', $kontakPesan) }}" onsubmit="return confirm('Kirim balasan ke alamat email pengirim?');">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="balasan">Isi balasan</label>
                    <textarea id="balasan" name="balasan" class="form-control" rows="8" required placeholder="Tulis balasan Anda di sini…">{{ old('balasan') }}</textarea>
                    @error('balasan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim balasan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
