<div class="card" style="margin-bottom:18px;">
    <div class="card-header"><span class="card-title">Halaman Donasi Keuangan (<code>/donasi/keuangan</code>)</span></div>
    <div class="card-body">
        <p style="margin:0 0 16px;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Teks hero, dampak, kutipan, label form, nominal cepat, modal QRIS, dan pesan validasi disimpan di kolom <code>donasi_keuangan_page</code> pada tabel <code>site_contents</code>.
            Navigasi atas dan footer situs tetap diatur di blok navigasi &amp; footer di halaman ini.
        </p>

        <div class="form-group">
            <label class="form-label" for="dk_page_title">Judul tab browser</label>
            <input id="dk_page_title" type="text" name="dk[page_title]" class="form-control" required
                value="{{ old('dk.page_title', data_get($donasiKeuangan, 'page_title')) }}">
            @error('dk.page_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_back_link">Teks tautan kembali</label>
            <input id="dk_back_link" type="text" name="dk[back_link]" class="form-control" required
                value="{{ old('dk.back_link', data_get($donasiKeuangan, 'back_link')) }}">
            @error('dk.back_link')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Hero</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_hero_icon">Ikon (Font Awesome)</label>
                <input id="dk_hero_icon" type="text" name="dk[hero][icon]" class="form-control" required value="{{ old('dk.hero.icon', data_get($donasiKeuangan, 'hero.icon')) }}">
                @error('dk.hero.icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_hero_title">Judul</label>
                <input id="dk_hero_title" type="text" name="dk[hero][title]" class="form-control" required value="{{ old('dk.hero.title', data_get($donasiKeuangan, 'hero.title')) }}">
                @error('dk.hero.title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_hero_lead">Paragraf pengantar</label>
            <textarea id="dk_hero_lead" name="dk[hero][lead]" class="form-control" rows="3" required>{{ old('dk.hero.lead', data_get($donasiKeuangan, 'hero.lead')) }}</textarea>
            @error('dk.hero.lead')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Dampak donasi</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_impact_title">Judul blok</label>
                <input id="dk_impact_title" type="text" name="dk[impact][title]" class="form-control" required value="{{ old('dk.impact.title', data_get($donasiKeuangan, 'impact.title')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_impact_title_icon">Ikon judul</label>
                <input id="dk_impact_title_icon" type="text" name="dk[impact][title_icon]" class="form-control" required value="{{ old('dk.impact.title_icon', data_get($donasiKeuangan, 'impact.title_icon')) }}">
            </div>
        </div>
        @foreach (range(0, 3) as $i)
            <div style="border:1px solid var(--gray-200);border-radius:10px;padding:12px;margin-top:10px;">
                <p style="font-size:12px;margin:0 0 8px;color:var(--gray-600);">Item dampak {{ $i + 1 }}</p>
                <div class="admin-grid-112">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="dk_imp_ico_{{ $i }}">Ikon</label>
                        <input id="dk_imp_ico_{{ $i }}" type="text" name="dk[impact][items][{{ $i }}][icon]" class="form-control" required value="{{ old('dk.impact.items.'.$i.'.icon', data_get($donasiKeuangan, 'impact.items.'.$i.'.icon')) }}">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="dk_imp_bg_{{ $i }}">Warna latar ikon (CSS)</label>
                        <input id="dk_imp_bg_{{ $i }}" type="text" name="dk[impact][items][{{ $i }}][bg]" class="form-control" value="{{ old('dk.impact.items.'.$i.'.bg', data_get($donasiKeuangan, 'impact.items.'.$i.'.bg')) }}">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="dk_imp_txt_{{ $i }}">Teks</label>
                        <input id="dk_imp_txt_{{ $i }}" type="text" name="dk[impact][items][{{ $i }}][text]" class="form-control" required value="{{ old('dk.impact.items.'.$i.'.text', data_get($donasiKeuangan, 'impact.items.'.$i.'.text')) }}">
                    </div>
                </div>
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Pesan kutipan</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_quote_bg">Latar kartu (CSS)</label>
                <input id="dk_quote_bg" type="text" name="dk[quote][card_bg]" class="form-control" value="{{ old('dk.quote.card_bg', data_get($donasiKeuangan, 'quote.card_bg')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_quote_title_icon">Ikon judul</label>
                <input id="dk_quote_title_icon" type="text" name="dk[quote][title_icon]" class="form-control" required value="{{ old('dk.quote.title_icon', data_get($donasiKeuangan, 'quote.title_icon')) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_quote_title">Judul</label>
            <input id="dk_quote_title" type="text" name="dk[quote][title]" class="form-control" required value="{{ old('dk.quote.title', data_get($donasiKeuangan, 'quote.title')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_quote_body">Isi kutipan</label>
            <textarea id="dk_quote_body" name="dk[quote][body]" class="form-control" rows="3" required>{{ old('dk.quote.body', data_get($donasiKeuangan, 'quote.body')) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_quote_attr">Atribusi</label>
            <input id="dk_quote_attr" type="text" name="dk[quote][attribution]" class="form-control" required value="{{ old('dk.quote.attribution', data_get($donasiKeuangan, 'quote.attribution')) }}">
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Form &amp; QRIS</p>
        <div class="form-group">
            <label class="form-label" for="dk_form_title">Judul form</label>
            <input id="dk_form_title" type="text" name="dk[form][title]" class="form-control" required value="{{ old('dk.form.title', data_get($donasiKeuangan, 'form.title')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_form_intro">Pengantar form</label>
            <textarea id="dk_form_intro" name="dk[form][intro]" class="form-control" rows="2" required>{{ old('dk.form.intro', data_get($donasiKeuangan, 'form.intro')) }}</textarea>
        </div>
        <input type="hidden" name="dk[form][qris_logo_storage]" value="{{ old('dk.form.qris_logo_storage', data_get($donasiKeuangan, 'form.qris_logo_storage')) }}">
        <div class="form-group">
            <label class="form-label" for="dk_qris_url">URL logo QRIS (fallback jika tanpa unggahan)</label>
            <input id="dk_qris_url" type="text" name="dk[form][qris_logo_url]" class="form-control" maxlength="500" value="{{ old('dk.form.qris_logo_url', data_get($donasiKeuangan, 'form.qris_logo_url')) }}" placeholder="https://...">
        </div>
        <div class="form-group">
            <label class="form-label" for="donasi_keuangan_qris_logo">Unggah logo QRIS (PNG/JPG, opsional)</label>
            @include('admin.partials.cms-current-file', [
                'url' => \App\Models\SiteContent::donasiKeuanganQrisLogoUrl((array) data_get($donasiKeuangan, 'form', [])),
                'path' => data_get($donasiKeuangan, 'form.qris_logo_storage') ?: data_get($donasiKeuangan, 'form.qris_logo_url'),
                'caption' => data_get($donasiKeuangan, 'form.qris_logo_storage') ? 'Unggahan CMS' : 'URL fallback / bawaan',
                'maxHeight' => '80px',
            ])
            <input id="donasi_keuangan_qris_logo" type="file" name="donasi_keuangan_qris_logo" class="form-control" accept="image/jpeg,image/png,image/webp,image/svg+xml">
            <label style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;color:var(--gray-600);">
                <input type="hidden" name="remove_donasi_keuangan_qris_logo" value="0">
                <input type="checkbox" name="remove_donasi_keuangan_qris_logo" value="1" {{ old('remove_donasi_keuangan_qris_logo') ? 'checked' : '' }}>
                Hapus logo unggahan (pakai URL di atas)
            </label>
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_qris_badge">Teks lencana QRIS di form</label>
            <input id="dk_qris_badge" type="text" name="dk[form][qris_badge_text]" class="form-control" required value="{{ old('dk.form.qris_badge_text', data_get($donasiKeuangan, 'form.qris_badge_text')) }}">
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Nominal cepat (nilai rupiah &amp; teks tombol)</p>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px;">
            @foreach (range(0, 5) as $i)
                <div style="border:1px solid var(--gray-200);border-radius:8px;padding:10px;">
                    <div class="form-group" style="margin-bottom:8px;">
                        <label class="form-label" for="dk_amt_{{ $i }}">Nilai {{ $i + 1 }}</label>
                        <input id="dk_amt_{{ $i }}" type="number" name="dk[form][amounts][{{ $i }}]" class="form-control" required min="1000" step="1000"
                            value="{{ old('dk.form.amounts.'.$i, data_get($donasiKeuangan, 'form.amounts.'.$i)) }}">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="dk_amt_lbl_{{ $i }}">Teks tombol</label>
                        <input id="dk_amt_lbl_{{ $i }}" type="text" name="dk[form][amount_labels][{{ $i }}]" class="form-control" required maxlength="40"
                            value="{{ old('dk.form.amount_labels.'.$i, data_get($donasiKeuangan, 'form.amount_labels.'.$i)) }}">
                    </div>
                </div>
            @endforeach
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Label &amp; placeholder field</p>
        @foreach ([
            'nominal_fast' => 'Label nominal cepat',
            'nominal_note' => 'Catatan nominal',
            'nama' => 'Label nama',
            'email' => 'Label email',
            'telepon' => 'Label telepon',
            'telepon_ph' => 'Placeholder telepon',
            'catatan' => 'Label pesan/doa',
            'catatan_note' => 'Catatan pesan',
            'nama_ph' => 'Placeholder nama',
            'nominal_ph' => 'Placeholder nominal manual',
            'catatan_ph' => 'Placeholder pesan',
            'email_ph' => 'Placeholder email',
        ] as $key => $lab)
            <div class="form-group">
                <label class="form-label" for="dk_f_{{ $key }}">{{ $lab }}</label>
                <input id="dk_f_{{ $key }}" type="text" name="dk[fields][{{ $key }}]" class="form-control" required value="{{ old('dk.fields.'.$key, data_get($donasiKeuangan, 'fields.'.$key)) }}">
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Tombol &amp; kepercayaan</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_btn_submit">Teks tombol bayar</label>
                <input id="dk_btn_submit" type="text" name="dk[buttons][submit]" class="form-control" required value="{{ old('dk.buttons.submit', data_get($donasiKeuangan, 'buttons.submit')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dk_btn_proc">Teks saat memproses</label>
                <input id="dk_btn_proc" type="text" name="dk[buttons][processing]" class="form-control" required value="{{ old('dk.buttons.processing', data_get($donasiKeuangan, 'buttons.processing')) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="dk_trust">Catatan kepercayaan (bawah form)</label>
            <input id="dk_trust" type="text" name="dk[trust_note]" class="form-control" required value="{{ old('dk.trust_note', data_get($donasiKeuangan, 'trust_note')) }}">
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Modal QRIS</p>
        @foreach ([
            'loading' => 'Teks memuat QR',
            'waiting' => 'Status menunggu',
            'checking' => 'Status memeriksa',
            'success' => 'Status sukses',
            'instruction_before' => 'Instruksi (baris 1)',
            'instruction_strong' => 'Teks tebal (nama menu scan)',
            'instruction_after' => 'Instruksi (lanjutan)',
            'prefix_nama' => 'Awalan nama di modal',
        ] as $key => $lab)
            <div class="form-group">
                <label class="form-label" for="dk_mod_{{ $key }}">{{ $lab }}</label>
                <input id="dk_mod_{{ $key }}" type="text" name="dk[modal][{{ $key }}]" class="form-control" required value="{{ old('dk.modal.'.$key, data_get($donasiKeuangan, 'modal.'.$key)) }}">
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Pesan validasi (JavaScript)</p>
        @foreach ([
            'nominal_min' => 'Nominal di bawah minimum',
            'nama_required' => 'Nama kosong',
            'email_invalid' => 'Email tidak valid',
            'connection' => 'Koneksi gagal',
            'api_prefix' => 'Awalan error API',
        ] as $key => $lab)
            <div class="form-group">
                <label class="form-label" for="dk_err_{{ $key }}">{{ $lab }}</label>
                <input id="dk_err_{{ $key }}" type="text" name="dk[errors][{{ $key }}]" class="form-control" required value="{{ old('dk.errors.'.$key, data_get($donasiKeuangan, 'errors.'.$key)) }}">
            </div>
        @endforeach

        <p style="margin-top:14px;font-size:13px;">
            <a href="{{ route('donasi.keuangan') }}" target="_blank" rel="noopener"><i class="fas fa-external-link-alt"></i> Pratinjau halaman publik</a>
        </p>
    </div>
</div>
