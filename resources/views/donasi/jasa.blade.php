@extends('layouts.app')

@section('title', $dj['page_title'] ?? 'Donasi Jasa - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.jasa-hero {
    background: linear-gradient(135deg, #064e3b 0%, #059669 55%, #34d399 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.jasa-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 25%, rgba(255,255,255,0.1) 0%, transparent 50%);
}
.back-link {
    display: inline-flex; align-items: center; gap: 0.4rem;
    color: rgba(255,255,255,0.8); text-decoration: none;
    font-size: 0.88rem; margin-bottom: 1.5rem; transition: opacity 0.2s; position: relative;
}
.back-link:hover { opacity:1; color: white; }
.jasa-hero h1 { font-size: clamp(1.8rem,4.5vw,2.8rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.jasa-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }
.jasa-hero i { color: #fff; }

.page-explanation {
    background: #F0FDF4;
    border: 1px solid #BBF7D0;
    border-radius: 16px;
    padding: 1.5rem 2rem;
    margin-bottom: 2rem;
}
.page-explanation h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #065f46;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.page-explanation h2 i { color: var(--biru-gelap); }
.page-explanation ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.page-explanation li {
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
    margin-bottom: 0.6rem;
    font-size: 0.95rem;
    color: #166534;
    line-height: 1.5;
}
.page-explanation li:last-child { margin-bottom: 0; }
.page-explanation li i {
    color: var(--biru-gelap);
    margin-top: 0.2rem;
    flex-shrink: 0;
}
.page-explanation-li-body {
    flex: 1;
    min-width: 0;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
.page-explanation-li-body strong { font-weight: 700; color: #065f46; }

.jasa-layout {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 2rem;
    align-items: start;
}
.form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 40px rgba(5,150,105,0.1);
    position: sticky;
    top: 88px;
}
.form-card > p i { color: var(--biru-gelap); margin-right: 0.25em; }
.info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(14,165,233,0.07);
    margin-bottom: 1.5rem;
}
.info-card h3 { font-size: 1.05rem; color: var(--biru-gelap); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; }
.info-card h3 > i { color: var(--biru-gelap); }
.jasa-layout .info-card ul li > i.fas { color: var(--biru-gelap); }

.jasa-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.6rem;
    margin-bottom: 0.75rem;
}
.jasa-chip {
    padding: 0.7rem 0.5rem;
    border: 2px solid #E2E8F0;
    border-radius: 12px;
    background: white;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.2rem;
}
.jasa-chip:hover { border-color: #059669; background: #F0FDF4; }
.jasa-chip.selected { border-color: #059669; background: linear-gradient(135deg, #059669, #10b981); color: white; }
.jasa-chip .jasa-icon { font-size: 1.4rem; line-height: 1; }
.jasa-chip.selected .jasa-icon i { color: #fff; }
.jasa-chip .jasa-label { font-size: 0.72rem; font-weight: 700; }

.jenis-chip-wrap {
    display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.25rem;
}
.jenis-chip {
    display: flex; align-items: center; gap: 0.4rem;
    padding: 0.5rem 0.9rem; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; border: none;
    cursor: default; font-family: inherit; transition: all 0.2s;
    border: 2px solid transparent;
}
.jenis-chip.green  { background: #D1FAE5; color: #065f46; }
.jenis-chip.blue   { background: #DBEAFE; color: #1E40AF; }
.jenis-chip.purple { background: #EDE9FE; color: #5B21B6; }
.jenis-chip.orange { background: #FEF3C7; color: #92400E; }
.jenis-chip.pink   { background: #FCE7F3; color: #9D174D; }

.how-item {
    display: flex; gap: 1rem; align-items: flex-start;
    margin-bottom: 1.25rem;
}
.how-num {
    width: 32px; height: 32px; min-width: 32px;
    background: linear-gradient(135deg, #059669, #10b981);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 0.85rem;
}
.how-text h4 { font-weight: 700; color: var(--teks-gelap); margin-bottom: 0.2rem; font-size: 0.93rem; }
.how-text p  { font-size: 0.83rem; color: var(--teks-muted); line-height: 1.5; }

.submit-btn {
    width: 100%; padding: 1rem;
    background: linear-gradient(135deg, #059669, #10B981);
    color: white; border: none; border-radius: 14px;
    font-size: 1.1rem; font-weight: 700;
    cursor: pointer; font-family: inherit; transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(5,150,105,0.3);
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(5,150,105,0.4); }
.submit-btn i { color: inherit; }

@media (max-width: 860px) {
    .jasa-layout { grid-template-columns: 1fr; }
    .form-card { position: static; }
    .jasa-grid { grid-template-columns: repeat(3,1fr); }
}
@media (max-width: 480px) {
    .jasa-grid { grid-template-columns: repeat(2,1fr); }
}
</style>
@endpush

@section('content')
@php
    $jasaChips = $dj['form']['chips'];
    $jasaLainnyaVal = end($jasaChips)['value'] ?? 'Lainnya';
    reset($jasaChips);
@endphp
<div class="jasa-hero">
    <a href="{{ route('donasi.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> {{ $dj['back_link'] }}
    </a>
    <h1>{{ $dj['hero']['title'] }}</h1>
    <p>{{ $dj['hero']['lead'] }}</p>
</div>

<div class="page-explanation">
    <h2><i class="{{ e($dj['explain']['title_icon']) }}" aria-hidden="true"></i> {{ $dj['explain']['title'] }}</h2>
    <ul>
        @foreach ($dj['explain']['items'] as $row)
            <li>
                <i class="{{ e($dj['explain']['list_icon']) }}" aria-hidden="true"></i>
                <div class="page-explanation-li-body">{{ $row['prefix'] }}<strong>{{ $row['strong'] }}</strong>{{ $row['suffix'] ?? '' }}</div>
            </li>
        @endforeach
    </ul>
</div>

<div class="jasa-layout">
    <div>
        <div class="info-card">
            <h3><i class="{{ e($dj['bidang']['title_icon']) }}" aria-hidden="true"></i> {{ $dj['bidang']['title'] }}</h3>
            <p style="color:var(--teks-muted); font-size:0.88rem; margin-bottom:1rem;">{{ $dj['bidang']['intro'] }}</p>
            <div class="jenis-chip-wrap">
                @foreach ($dj['bidang']['chips'] as $chip)
                    <span class="jenis-chip {{ e($chip['style']) }}">{{ $chip['label'] }}</span>
                @endforeach
            </div>
        </div>

        <div class="info-card">
            <h3><i class="{{ e($dj['alur']['title_icon']) }}" aria-hidden="true"></i> {{ $dj['alur']['title'] }}</h3>
            @foreach ($dj['alur']['steps'] as $idx => $step)
                <div class="how-item" @if($idx === count($dj['alur']['steps']) - 1) style="margin-bottom:0;" @endif>
                    <div class="how-num">{{ $step['num'] }}</div>
                    <div class="how-text">
                        <h4>{{ $step['title'] }}</h4>
                        <p>{{ $step['body'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="info-card" style="background: {{ e($dj['benefits']['card_style']) }}; border: {{ e($dj['benefits']['border']) }};">
            <h3><i class="{{ e($dj['benefits']['title_icon']) }}" aria-hidden="true"></i> {{ $dj['benefits']['title'] }}</h3>
            <ul style="list-style:none; padding:0;">
                @foreach ($dj['benefits']['items'] as $line)
                    <li style="display:flex; align-items:center; gap:0.6rem; font-size:0.88rem; color:#065f46;{{ $loop->last ? '' : ' margin-bottom:0.75rem;' }}">
                        <i class="fas fa-check-circle" aria-hidden="true"></i> {{ $line }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="form-card">
        <h2 style="font-size:1.4rem; color:var(--biru-gelap); margin-bottom:0.4rem;">{{ $dj['form']['title'] }}</h2>
        <p style="color:var(--teks-muted); font-size:0.9rem; margin-bottom:2rem;">{{ $dj['form']['intro'] }}</p>

        <form action="{{ route('donasi.jasa.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>{{ $dj['fields']['jenis_label'] }}</label>
                <div class="jasa-grid" id="jasaGrid">
                    @foreach ($dj['form']['chips'] as $chip)
                        <button type="button" class="jasa-chip" data-value="{{ e($chip['value']) }}" onclick="setJasaFromBtn(this)">
                            <span class="jasa-icon">{{ $chip['icon'] }}</span><span class="jasa-label">{{ $chip['label'] }}</span>
                        </button>
                    @endforeach
                </div>
                <input type="hidden" id="jenis_jasa" name="jenis_jasa" value="{{ old('jenis_jasa') }}">
                <input type="text" id="jenis_jasa_custom" placeholder="{{ $dj['fields']['jenis_custom_ph'] }}"
                    style="margin-top:0.5rem;" oninput="document.getElementById('jenis_jasa').value=this.value">
                @error('jenis_jasa')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>{{ $dj['fields']['nama'] }}</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="{{ $dj['fields']['nama_ph'] }}">
                @error('nama')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>{{ $dj['fields']['email'] }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="{{ $dj['fields']['email_ph'] }}">
                    @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>{{ $dj['fields']['telepon'] }}</label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="{{ $dj['fields']['telepon_ph'] }}">
                </div>
            </div>
            <div class="form-group">
                <label>{{ $dj['fields']['instansi'] }}</label>
                <input type="text" name="instansi" value="{{ old('instansi') }}" placeholder="{{ $dj['fields']['instansi_ph'] }}">
            </div>
            <div class="form-group">
                <label>{{ $dj['fields']['keahlian'] }}</label>
                <textarea name="keahlian" required placeholder="{{ $dj['fields']['keahlian_ph'] }}">{{ old('keahlian') }}</textarea>
                @error('keahlian')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>{{ $dj['fields']['tanggal_mulai'] }}</label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required min="{{ date('Y-m-d') }}">
                    @error('tanggal_mulai')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>{{ $dj['fields']['durasi'] }}</label>
                    <select name="durasi" required>
                        <option value="" disabled @if(! old('durasi')) selected @endif>{{ $dj['form']['durasi_placeholder'] }}</option>
                        @foreach ($dj['form']['durasi_options'] as $opt)
                            <option value="{{ e($opt['value']) }}" @if(old('durasi') === $opt['value']) selected @endif>{{ $opt['label'] }}</option>
                        @endforeach
                    </select>
                    @error('durasi')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>{{ $dj['fields']['deskripsi'] }}</label>
                <textarea name="deskripsi" required style="min-height:100px;"
                    placeholder="{{ $dj['fields']['deskripsi_ph'] }}">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $dj['fields']['catatan'] }}</label>
                <textarea name="catatan" placeholder="{{ $dj['fields']['catatan_ph'] }}">{{ old('catatan') }}</textarea>
            </div>
            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> {{ $dj['buttons']['submit'] }}
            </button>
        </form>
        <p style="text-align:center; margin-top:1rem; font-size:0.8rem; color:#94A3B8;">
            <i class="fas fa-clock"></i> {{ $dj['footer_note'] }}
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
const JASA_LAINNYA_VALUE = @json($jasaLainnyaVal);

function setJasaFromBtn(btn) {
    const val = btn.getAttribute('data-value');
    document.querySelectorAll('.jasa-chip').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('jenis_jasa').value = val;
    const custom = document.getElementById('jenis_jasa_custom');
    custom.value = (val !== JASA_LAINNYA_VALUE) ? val : '';
}
</script>
@endpush
