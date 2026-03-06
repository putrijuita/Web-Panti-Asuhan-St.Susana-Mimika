@extends('admin.layouts.app')

@section('title', 'Detail Donasi')
@section('page-title', 'Detail Donasi')
@section('page-subtitle', 'Informasi lengkap donasi')

@section('content')
<div style="display:flex;gap:20px;flex-wrap:wrap;">
    <div style="flex:2;min-width:280px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fas fa-hand-holding-heart" style="color:#3b82f6;margin-right:8px;"></i>Informasi Donasi</span>
                <a href="{{ route('admin.donasi.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="padding:10px 0;width:40%;color:#64748b;font-size:13px;vertical-align:top;">Order ID</td>
                            <td style="padding:10px 0;font-size:13.5px;font-weight:600;">
                                <code style="background:#f1f5f9;padding:3px 8px;border-radius:5px;">{{ $donasi->order_id ?? '-' }}</code>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Nama Donatur</td>
                            <td style="padding:10px 0;font-size:13.5px;font-weight:600;border-top:1px solid #f1f5f9;">{{ $donasi->nama }}</td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Email</td>
                            <td style="padding:10px 0;font-size:13.5px;border-top:1px solid #f1f5f9;">{{ $donasi->email }}</td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Telepon</td>
                            <td style="padding:10px 0;font-size:13.5px;border-top:1px solid #f1f5f9;">{{ $donasi->telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Nominal</td>
                            <td style="padding:10px 0;font-size:20px;font-weight:700;color:#059669;border-top:1px solid #f1f5f9;">
                                Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Metode Bayar</td>
                            <td style="padding:10px 0;border-top:1px solid #f1f5f9;">
                                @if($donasi->payment_type)
                                    <span class="badge badge-info">{{ str_replace('_',' ',ucfirst($donasi->payment_type)) }}</span>
                                @else
                                    <span style="color:#94a3b8;font-size:13px;">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Catatan</td>
                            <td style="padding:10px 0;font-size:13.5px;border-top:1px solid #f1f5f9;">{{ $donasi->catatan ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;color:#64748b;font-size:13px;border-top:1px solid #f1f5f9;vertical-align:top;">Tanggal</td>
                            <td style="padding:10px 0;font-size:13.5px;border-top:1px solid #f1f5f9;">{{ $donasi->created_at->format('d F Y, H:i') }}</td>
                        </tr>
                    </tbody>
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
                    $statusClass = match($donasi->status) {
                        'settlement','completed' => 'badge-success',
                        'pending','capture' => 'badge-warning',
                        'cancel','expire','failure','deny' => 'badge-danger',
                        default => 'badge-gray'
                    };
                @endphp
                <div style="text-align:center;margin-bottom:20px;">
                    <span class="badge {{ $statusClass }}" style="font-size:14px;padding:6px 16px;">
                        {{ ucfirst($donasi->status) }}
                    </span>
                </div>
                <form method="POST" action="{{ route('admin.donasi.status', $donasi) }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Ubah Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $donasi->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="settlement" {{ $donasi->status=='settlement'?'selected':'' }}>Settlement</option>
                            <option value="completed" {{ $donasi->status=='completed'?'selected':'' }}>Completed</option>
                            <option value="cancel" {{ $donasi->status=='cancel'?'selected':'' }}>Cancel</option>
                            <option value="expire" {{ $donasi->status=='expire'?'selected':'' }}>Expire</option>
                            <option value="failure" {{ $donasi->status=='failure'?'selected':'' }}>Failure</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-save"></i> Simpan Status
                    </button>
                </form>
                <hr style="border:none;border-top:1px solid #f1f5f9;margin:16px 0;">
                <form method="POST" action="{{ route('admin.donasi.destroy', $donasi) }}" onsubmit="return confirm('Hapus donasi ini secara permanen?')">
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
