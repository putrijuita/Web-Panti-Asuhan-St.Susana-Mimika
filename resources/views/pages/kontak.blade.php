@extends('layouts.app')

@section('title', $kontakPage->page_meta_title ?? 'Kontak')

@push('styles')
<style>
.kontak-hero {
    position: relative;
    text-align: center;
    padding: 3.5rem 2rem 3rem;
    overflow: hidden;
    margin-bottom: 3rem;
    border-radius: 24px;
}
.kontak-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 24px;
    background:
        radial-gradient(ellipse at 15% 50%, rgba(14, 165, 233, 0.12) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 50%, rgba(56, 189, 248, 0.12) 0%, transparent 55%);
    pointer-events: none;
}
.kontak-hero h1 {
    font-size: clamp(2rem, 5vw, 2.8rem);
    font-weight: 800;
    color: var(--biru-gelap);
    margin-bottom: 1rem;
    position: relative;
}
.kontak-hero h1 .kontak-hero-icon {
    color: var(--aksen);
    margin-right: 0.35rem;
}
.kontak-hero p {
    font-size: 1.05rem;
    color: var(--teks-muted);
    max-width: 560px;
    margin: 0 auto;
    line-height: 1.7;
    position: relative;
}

.kontak-hero-image {
    position: relative;
    max-width: min(520px, 100%);
    margin: 0 auto 1.25rem;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(8, 47, 73, 0.1);
}
.kontak-hero-image img {
    display: block;
    width: 100%;
    height: auto;
    vertical-align: middle;
}

.kontak-layout {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 2rem;
    align-items: start;
}
.kontak-form-card {
    background: var(--putih);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 36px rgba(8, 47, 73, 0.09);
    position: sticky;
    top: 88px;
}
.kontak-form-card h2 { font-size: 1.4rem; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.kontak-form-card .subtitle { color: var(--teks-muted); font-size: 0.9rem; margin-bottom: 2rem; }

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, var(--aksen), var(--aksen-hover));
    color: var(--putih);
    border: none;
    border-radius: 14px;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 6px 24px rgba(8, 47, 73, 0.18);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(8, 47, 73, 0.22);
    filter: brightness(1.03);
}

.kontak-info-card {
    background: var(--putih);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 28px rgba(8, 47, 73, 0.08);
    margin-bottom: 1.5rem;
}
.kontak-info-card h3 {
    font-size: 1.05rem;
    color: var(--biru-gelap);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.kontak-info-card h3 > i { color: var(--aksen); }

.kontak-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    margin-bottom: 1.25rem;
    padding: 1rem;
    border-radius: 14px;
    background: var(--latar-panel);
    border: 1px solid transparent;
    transition: background 0.2s, border-color 0.2s, transform 0.2s;
}
.kontak-item:hover {
    background: rgba(14, 165, 233, 0.06);
    border-color: rgba(14, 165, 233, 0.12);
    transform: translateX(4px);
}
.kontak-item-icon {
    width: 44px; height: 44px; min-width: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    color: var(--putih);
}
.kontak-item-body h4  { font-weight: 700; font-size: 0.9rem; color: var(--teks-gelap); margin-bottom: 0.25rem; }
.kontak-item-body p   { font-size: 0.85rem; color: var(--teks-muted); line-height: 1.5; }
.kontak-item-body a   { color: var(--aksen); text-decoration: none; font-weight: 600; }
.kontak-item-body a:hover { text-decoration: underline; color: var(--aksen-hover); }
a.kontak-item--maps {
    text-decoration: none;
    color: inherit;
    cursor: pointer;
}
a.kontak-item--maps .kontak-item-body p { color: var(--teks-muted); }
a.kontak-item--maps .kontak-maps-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    margin-top: 0.5rem;
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--aksen);
}
a.kontak-item--maps:hover .kontak-maps-cta { color: var(--aksen-hover); text-decoration: underline; }
.kontak-item-note { font-size: 0.8rem; color: var(--teks-muted); margin-top: 0.2rem; opacity: 0.9; }

.sosmed-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}
.sosmed-btn {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.85rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
    color: var(--putih);
}
.sosmed-btn:hover { transform: translateY(-2px); color: var(--putih); filter: brightness(1.05); }
.sosmed-btn.fb { background: linear-gradient(135deg, var(--biru-muda-gelap), var(--biru-gelap)); color: white; }
.sosmed-btn.ig { background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap)); color: white; }
.sosmed-btn.wa { background: linear-gradient(135deg, #3d6b4f, var(--aksen-zaitun)); color: white; }
.sosmed-btn.phone { background: linear-gradient(135deg, var(--aksen), var(--aksen-hover)); color: white; }

.jam-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
}
.jam-item {
    background: var(--latar-panel);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 0.75rem;
    font-size: 0.85rem;
}
.jam-item .hari   { color: var(--teks-muted); }
.jam-item .waktu  { font-weight: 700; color: var(--biru-gelap); }
.jam-item .waktu--muted { color: var(--aksen); font-weight: 700; }

.faq-item {
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 0.75rem;
    background: var(--putih);
}
.faq-question {
    padding: 1rem 1.25rem;
    font-weight: 600;
    color: var(--teks-gelap);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--putih);
    transition: background 0.2s;
    font-family: inherit;
    border: none;
    width: 100%;
    text-align: left;
    font-size: 0.95rem;
}
.faq-question:hover { background: var(--latar-panel); }
.faq-answer {
    padding: 0 1.25rem;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease, padding 0.35s;
    font-size: 0.9rem;
    color: var(--teks-muted);
    line-height: 1.6;
}
.faq-answer.open { max-height: 320px; padding: 0 1.25rem 1rem; }

.kontak-form-foot {
    text-align: center;
    margin-top: 1.25rem;
    font-size: 0.82rem;
    color: var(--teks-muted);
}
.kontak-form-divider {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}
.kontak-form-divider > p { font-size: 0.85rem; color: var(--teks-muted); text-align: center; margin-bottom: 0.75rem; }

@media (max-width: 860px) {
    .kontak-layout { grid-template-columns: 1fr; }
    .kontak-form-card { position: static; }
    .sosmed-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="kontak-hero">
    @if(!empty($kontakPage->hero_image))
        <div class="kontak-hero-image">
            <img src="{{ asset('storage/'.$kontakPage->hero_image) }}" alt="">
        </div>
    @endif
    <h1><i class="{{ $kontakPage->hero_icon }} kontak-hero-icon" aria-hidden="true"></i>{{ $kontakPage->hero_title }}</h1>
    <p>{{ $kontakPage->hero_subtitle }}</p>
</div>

<div class="kontak-layout">
    <div>
        <div class="kontak-info-card">
            <h3><i class="{{ $kontakPage->info_block_icon }}" aria-hidden="true"></i> {{ $kontakPage->info_block_title }}</h3>
            <div class="kontak-item">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));">
                    <i class="{{ $kontakPage->phone_item_icon }}" aria-hidden="true"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>{{ $kontakPage->phone_title }}</h4>
                    <p><a href="{{ $kontakPage->phone_href }}">{{ $kontakPage->phone_display }}</a></p>
                    <p class="kontak-item-note">{{ $kontakPage->phone_note }}</p>
                </div>
            </div>
            <div class="kontak-item">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));">
                    <i class="{{ $kontakPage->fb_item_icon }}" aria-hidden="true"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>{{ $kontakPage->fb_title }}</h4>
                    <p><a href="{{ $kontakPage->fb_url }}" target="_blank" rel="noopener noreferrer">{{ $kontakPage->fb_link_text }}</a></p>
                    @if(filled($kontakPage->fb_note))
                        <p class="kontak-item-note">{{ $kontakPage->fb_note }}</p>
                    @endif
                </div>
            </div>
            <div class="kontak-item">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));">
                    <i class="{{ $kontakPage->ig_item_icon }}" aria-hidden="true"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>{{ $kontakPage->ig_title }}</h4>
                    <p><a href="{{ $kontakPage->ig_url }}" target="_blank" rel="noopener">{{ $kontakPage->ig_link_text }}</a></p>
                </div>
            </div>
            <a href="{{ \App\Models\KontakPageContent::resolvedGoogleMapsUrl($kontakPage) }}" target="_blank" rel="noopener noreferrer" class="kontak-item kontak-item--maps" style="margin-bottom: 0;" title="Buka lokasi di Google Maps">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));">
                    <i class="{{ $kontakPage->addr_item_icon }}" aria-hidden="true"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>{{ $kontakPage->addr_title }}</h4>
                    <p>{{ $kontakPage->addr_line1 }}</p>
                    <p>{{ $kontakPage->addr_line2 }}</p>
                    <p>{{ $kontakPage->addr_line3 }}</p>
                    <span class="kontak-maps-cta"><i class="fas fa-map-location-dot" aria-hidden="true"></i> Buka di Google Maps</span>
                </div>
            </a>
        </div>

        <div class="kontak-info-card">
            <h3><i class="{{ $kontakPage->quick_block_icon }}" aria-hidden="true"></i> {{ $kontakPage->quick_block_title }}</h3>
            <div class="sosmed-grid">
                <a href="{{ $kontakPage->quick_fb_url }}" target="_blank" rel="noopener noreferrer" class="sosmed-btn fb" style="grid-column: span 2;">
                    <i class="fab fa-facebook-f" aria-hidden="true"></i> {{ $kontakPage->quick_fb_text }}
                </a>
                <a href="{{ $kontakPage->quick_ig_url }}" target="_blank" rel="noopener" class="sosmed-btn ig" style="grid-column: span 2;">
                    <i class="fab fa-instagram" aria-hidden="true"></i> {{ $kontakPage->quick_ig_text }}
                </a>
                <a href="{{ $kontakPage->quick_phone_url }}" class="sosmed-btn phone" style="grid-column: span 2;">
                    <i class="fas fa-phone" aria-hidden="true"></i> {{ $kontakPage->quick_phone_text }}
                </a>
            </div>
        </div>

        <div class="kontak-info-card">
            <h3><i class="{{ $kontakPage->jam_block_icon }}" aria-hidden="true"></i> {{ $kontakPage->jam_block_title }}</h3>
            <div class="jam-grid">
                <div class="jam-item"><div class="hari">{{ $kontakPage->jam_row1_hari }}</div><div class="waktu">{{ $kontakPage->jam_row1_waktu }}</div></div>
                <div class="jam-item"><div class="hari">{{ $kontakPage->jam_row2_hari }}</div><div class="waktu">{{ $kontakPage->jam_row2_waktu }}</div></div>
                <div class="jam-item" style="grid-column:span 2;"><div class="hari">{{ $kontakPage->jam_row3_hari }}</div><div class="waktu waktu--muted">{{ $kontakPage->jam_row3_waktu }}</div></div>
            </div>
        </div>

        <div class="kontak-info-card">
            <h3><i class="{{ $kontakPage->faq_block_icon }}" aria-hidden="true"></i> {{ $kontakPage->faq_block_title }}</h3>
            @for ($f = 1; $f <= 4; $f++)
                @php $q = $kontakPage->{'faq'.$f.'_q'}; $a = $kontakPage->{'faq'.$f.'_a'}; @endphp
                <div class="faq-item">
                    <button type="button" class="faq-question" onclick="toggleFaq(this)">
                        {{ $q }} <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <div class="faq-answer">{{ $a }}</div>
                </div>
            @endfor
        </div>
    </div>

    <div class="kontak-form-card">
        <h2>{{ $kontakPage->form_title }}</h2>
        <p class="subtitle">{{ $kontakPage->form_subtitle }}</p>

        <form action="{{ route('kontak.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>{{ $kontakPage->lbl_nama }}</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="{{ $kontakPage->ph_nama }}">
                @error('nama')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $kontakPage->lbl_email }}</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="{{ $kontakPage->ph_email }}">
                @error('email')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $kontakPage->lbl_subjek }}</label>
                <select name="subjek" required>
                    <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>{{ $kontakPage->select_placeholder }}</option>
                    @for ($o = 1; $o <= 6; $o++)
                        @php $ov = $kontakPage->{'opt'.$o.'_value'}; $ol = $kontakPage->{'opt'.$o.'_label'}; @endphp
                        <option value="{{ $ov }}" {{ old('subjek') === $ov ? 'selected' : '' }}>{{ $ol }}</option>
                    @endfor
                </select>
                @error('subjek')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $kontakPage->lbl_pesan }}</label>
                <textarea name="pesan" required placeholder="{{ $kontakPage->ph_pesan }}" style="min-height: 150px;">{{ old('pesan') }}</textarea>
                @error('pesan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="submit-btn"><i class="{{ $kontakPage->btn_submit_icon }}" aria-hidden="true"></i> {{ $kontakPage->btn_submit_text }}</button>
        </form>

        <div class="kontak-form-foot">
            <i class="{{ $kontakPage->form_footer_icon }}" aria-hidden="true"></i> {{ $kontakPage->form_footer_text }}
        </div>

        <div class="kontak-form-divider">
            <p>{{ $kontakPage->divider_text }}</p>
            <div style="display: flex; gap: 0.75rem; justify-content: center;">
                <a href="{{ $kontakPage->divider_btn_href }}" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                    <i class="{{ $kontakPage->divider_btn_icon }}" aria-hidden="true"></i> {{ $kontakPage->divider_btn_text }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleFaq(btn) {
    const answer = btn.nextElementSibling;
    const icon = btn.querySelector('.fa-chevron-down, .fa-chevron-up');
    const isOpen = answer.classList.contains('open');

    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-question i').forEach(i => {
        i.classList.remove('fa-chevron-up');
        i.classList.add('fa-chevron-down');
    });

    if (!isOpen) {
        answer.classList.add('open');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    }
}
</script>
@endpush
