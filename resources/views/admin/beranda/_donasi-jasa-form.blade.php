<div class="card" style="margin-bottom:18px;">
    <div class="card-header"><span class="card-title">Halaman Donasi Jasa (<code>/donasi/jasa</code>)</span></div>
    <div class="card-body">
        <p style="margin:0 0 16px;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Hero, penjelasan, bidang jasa, alur, manfaat, label form, pilihan jenis (nilai tersimpan), opsi durasi, dan tombol — disimpan di kolom <code>donasi_jasa_page</code> pada <code>site_contents</code>.
            Navigasi &amp; footer situs sama seperti blok di atas.
        </p>

        <div class="form-group">
            <label class="form-label" for="dj_page_title">Judul tab browser</label>
            <input id="dj_page_title" type="text" name="dj[page_title]" class="form-control" required value="{{ old('dj.page_title', data_get($donasiJasa, 'page_title')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_back_link">Teks tautan kembali</label>
            <input id="dj_back_link" type="text" name="dj[back_link]" class="form-control" required value="{{ old('dj.back_link', data_get($donasiJasa, 'back_link')) }}">
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Hero</p>
        <div class="form-group">
            <label class="form-label" for="dj_hero_title">Judul (boleh emoji)</label>
            <input id="dj_hero_title" type="text" name="dj[hero][title]" class="form-control" required value="{{ old('dj.hero.title', data_get($donasiJasa, 'hero.title')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_hero_lead">Paragraf</label>
            <textarea id="dj_hero_lead" name="dj[hero][lead]" class="form-control" rows="3" required>{{ old('dj.hero.lead', data_get($donasiJasa, 'hero.lead')) }}</textarea>
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Kotak &quot;Apa itu Donasi Jasa?&quot;</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_ex_title">Judul</label>
                <input id="dj_ex_title" type="text" name="dj[explain][title]" class="form-control" required value="{{ old('dj.explain.title', data_get($donasiJasa, 'explain.title')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_ex_title_icon">Ikon judul (FA)</label>
                <input id="dj_ex_title_icon" type="text" name="dj[explain][title_icon]" class="form-control" required value="{{ old('dj.explain.title_icon', data_get($donasiJasa, 'explain.title_icon')) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_ex_list_icon">Ikon tiap poin daftar (FA)</label>
            <input id="dj_ex_list_icon" type="text" name="dj[explain][list_icon]" class="form-control" required value="{{ old('dj.explain.list_icon', data_get($donasiJasa, 'explain.list_icon')) }}">
        </div>
        @foreach (range(0, 2) as $i)
            <div style="border:1px solid var(--gray-200);border-radius:10px;padding:12px;margin-top:10px;">
                <p style="font-size:12px;margin:0 0 8px;color:var(--gray-600);">Poin {{ $i + 1 }} (teks sebelum &lt;strong&gt;, tebal, sesudah)</p>
                <div class="form-group">
                    <label class="form-label" for="dj_ex_pfx_{{ $i }}">Teks sebelum tebal</label>
                    <input id="dj_ex_pfx_{{ $i }}" type="text" name="dj[explain][items][{{ $i }}][prefix]" class="form-control" required value="{{ old('dj.explain.items.'.$i.'.prefix', data_get($donasiJasa, 'explain.items.'.$i.'.prefix')) }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="dj_ex_str_{{ $i }}">Teks tebal</label>
                    <input id="dj_ex_str_{{ $i }}" type="text" name="dj[explain][items][{{ $i }}][strong]" class="form-control" required value="{{ old('dj.explain.items.'.$i.'.strong', data_get($donasiJasa, 'explain.items.'.$i.'.strong')) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="dj_ex_suf_{{ $i }}">Teks setelah tebal</label>
                    <input id="dj_ex_suf_{{ $i }}" type="text" name="dj[explain][items][{{ $i }}][suffix]" class="form-control" value="{{ old('dj.explain.items.'.$i.'.suffix', data_get($donasiJasa, 'explain.items.'.$i.'.suffix')) }}">
                </div>
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Bidang jasa (kartu kiri — 12 chip tampilan)</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_bd_title">Judul</label>
                <input id="dj_bd_title" type="text" name="dj[bidang][title]" class="form-control" required value="{{ old('dj.bidang.title', data_get($donasiJasa, 'bidang.title')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_bd_icon">Ikon judul</label>
                <input id="dj_bd_icon" type="text" name="dj[bidang][title_icon]" class="form-control" required value="{{ old('dj.bidang.title_icon', data_get($donasiJasa, 'bidang.title_icon')) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_bd_intro">Pengantar</label>
            <input id="dj_bd_intro" type="text" name="dj[bidang][intro]" class="form-control" required value="{{ old('dj.bidang.intro', data_get($donasiJasa, 'bidang.intro')) }}">
        </div>
        @foreach (range(0, 11) as $i)
            <div class="admin-grid-21 admin-mt-8">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="dj_bd_lbl_{{ $i }}">Chip {{ $i + 1 }}</label>
                    <input id="dj_bd_lbl_{{ $i }}" type="text" name="dj[bidang][chips][{{ $i }}][label]" class="form-control" required value="{{ old('dj.bidang.chips.'.$i.'.label', data_get($donasiJasa, 'bidang.chips.'.$i.'.label')) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="dj_bd_sty_{{ $i }}">Warna</label>
                    <select id="dj_bd_sty_{{ $i }}" name="dj[bidang][chips][{{ $i }}][style]" class="form-control" required>
                        @foreach (['green','blue','purple','orange','pink'] as $st)
                            <option value="{{ $st }}" {{ old('dj.bidang.chips.'.$i.'.style', data_get($donasiJasa, 'bidang.chips.'.$i.'.style')) === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Alur (4 langkah)</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_al_title">Judul blok</label>
                <input id="dj_al_title" type="text" name="dj[alur][title]" class="form-control" required value="{{ old('dj.alur.title', data_get($donasiJasa, 'alur.title')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_al_icon">Ikon judul</label>
                <input id="dj_al_icon" type="text" name="dj[alur][title_icon]" class="form-control" required value="{{ old('dj.alur.title_icon', data_get($donasiJasa, 'alur.title_icon')) }}">
            </div>
        </div>
        @foreach (range(0, 3) as $i)
            <div style="border:1px solid var(--gray-200);border-radius:10px;padding:12px;margin-top:10px;">
                <p style="font-size:12px;margin:0 0 8px;">Langkah {{ $i + 1 }}</p>
                <div class="admin-grid-icon-text">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="dj_al_n_{{ $i }}">Nomor</label>
                        <input id="dj_al_n_{{ $i }}" type="text" name="dj[alur][steps][{{ $i }}][num]" class="form-control" required value="{{ old('dj.alur.steps.'.$i.'.num', data_get($donasiJasa, 'alur.steps.'.$i.'.num')) }}">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="dj_al_ti_{{ $i }}">Judul langkah</label>
                        <input id="dj_al_ti_{{ $i }}" type="text" name="dj[alur][steps][{{ $i }}][title]" class="form-control" required value="{{ old('dj.alur.steps.'.$i.'.title', data_get($donasiJasa, 'alur.steps.'.$i.'.title')) }}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="dj_al_bd_{{ $i }}">Deskripsi</label>
                    <textarea id="dj_al_bd_{{ $i }}" name="dj[alur][steps][{{ $i }}][body]" class="form-control" rows="2" required>{{ old('dj.alur.steps.'.$i.'.body', data_get($donasiJasa, 'alur.steps.'.$i.'.body')) }}</textarea>
                </div>
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Manfaat untuk relawan</p>
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_bn_title">Judul</label>
                <input id="dj_bn_title" type="text" name="dj[benefits][title]" class="form-control" required value="{{ old('dj.benefits.title', data_get($donasiJasa, 'benefits.title')) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="dj_bn_icon">Ikon judul</label>
                <input id="dj_bn_icon" type="text" name="dj[benefits][title_icon]" class="form-control" required value="{{ old('dj.benefits.title_icon', data_get($donasiJasa, 'benefits.title_icon')) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_bn_card">Latar kartu (CSS)</label>
            <input id="dj_bn_card" type="text" name="dj[benefits][card_style]" class="form-control" required value="{{ old('dj.benefits.card_style', data_get($donasiJasa, 'benefits.card_style')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_bn_border">Border (CSS)</label>
            <input id="dj_bn_border" type="text" name="dj[benefits][border]" class="form-control" required value="{{ old('dj.benefits.border', data_get($donasiJasa, 'benefits.border')) }}">
        </div>
        @foreach (range(0, 3) as $i)
            <div class="form-group">
                <label class="form-label" for="dj_bn_it_{{ $i }}">Poin {{ $i + 1 }}</label>
                <input id="dj_bn_it_{{ $i }}" type="text" name="dj[benefits][items][{{ $i }}]" class="form-control" required value="{{ old('dj.benefits.items.'.$i, data_get($donasiJasa, 'benefits.items.'.$i)) }}">
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Form — judul &amp; pilihan</p>
        <div class="form-group">
            <label class="form-label" for="dj_fm_title">Judul form</label>
            <input id="dj_fm_title" type="text" name="dj[form][title]" class="form-control" required value="{{ old('dj.form.title', data_get($donasiJasa, 'form.title')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_fm_intro">Pengantar form</label>
            <textarea id="dj_fm_intro" name="dj[form][intro]" class="form-control" rows="2" required>{{ old('dj.form.intro', data_get($donasiJasa, 'form.intro')) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_fm_dur_ph">Placeholder pilihan durasi kosong</label>
            <input id="dj_fm_dur_ph" type="text" name="dj[form][durasi_placeholder]" class="form-control" required value="{{ old('dj.form.durasi_placeholder', data_get($donasiJasa, 'form.durasi_placeholder')) }}">
        </div>

        <p style="font-size:12px;color:var(--gray-500);margin:8px 0;">Tombol jenis jasa (9) — <strong>nilai</strong> dikirim ke server (ubah hati-hati agar sesuai validasi backend)</p>
        @foreach (range(0, 8) as $i)
            <div class="admin-grid-cta-row admin-mt-8">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Nilai tersimpan #{{ $i + 1 }}</label>
                    <input type="text" name="dj[form][chips][{{ $i }}][value]" class="form-control" required value="{{ old('dj.form.chips.'.$i.'.value', data_get($donasiJasa, 'form.chips.'.$i.'.value')) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Ikon</label>
                    <input type="text" name="dj[form][chips][{{ $i }}][icon]" class="form-control" required maxlength="32" value="{{ old('dj.form.chips.'.$i.'.icon', data_get($donasiJasa, 'form.chips.'.$i.'.icon')) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Label</label>
                    <input type="text" name="dj[form][chips][{{ $i }}][label]" class="form-control" required value="{{ old('dj.form.chips.'.$i.'.label', data_get($donasiJasa, 'form.chips.'.$i.'.label')) }}">
                </div>
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;">Opsi durasi (6) — nilai = yang disimpan di database</p>
        @foreach (range(0, 5) as $i)
            <div class="admin-grid-2 admin-mt-8">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Nilai #{{ $i + 1 }}</label>
                    <input type="text" name="dj[form][durasi_options][{{ $i }}][value]" class="form-control" required value="{{ old('dj.form.durasi_options.'.$i.'.value', data_get($donasiJasa, 'form.durasi_options.'.$i.'.value')) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Teks tampil</label>
                    <input type="text" name="dj[form][durasi_options][{{ $i }}][label]" class="form-control" required value="{{ old('dj.form.durasi_options.'.$i.'.label', data_get($donasiJasa, 'form.durasi_options.'.$i.'.label')) }}">
                </div>
            </div>
        @endforeach

        <p style="font-size:12px;color:var(--gray-500);margin:16px 0 8px;font-weight:600;">Label &amp; placeholder field</p>
        @foreach ([
            'jenis_label' => 'Label jenis jasa',
            'jenis_custom_ph' => 'Placeholder jenis manual',
            'nama' => 'Label nama',
            'nama_ph' => 'Placeholder nama',
            'email' => 'Label email',
            'email_ph' => 'Placeholder email',
            'telepon' => 'Label telepon',
            'telepon_ph' => 'Placeholder telepon',
            'instansi' => 'Label instansi',
            'instansi_ph' => 'Placeholder instansi',
            'keahlian' => 'Label keahlian',
            'keahlian_ph' => 'Placeholder keahlian',
            'tanggal_mulai' => 'Label tanggal mulai',
            'durasi' => 'Label durasi',
            'deskripsi' => 'Label deskripsi',
            'deskripsi_ph' => 'Placeholder deskripsi',
            'catatan' => 'Label catatan',
            'catatan_ph' => 'Placeholder catatan',
        ] as $key => $lab)
            <div class="form-group">
                <label class="form-label" for="dj_f_{{ $key }}">{{ $lab }}</label>
                <input id="dj_f_{{ $key }}" type="text" name="dj[fields][{{ $key }}]" class="form-control" required value="{{ old('dj.fields.'.$key, data_get($donasiJasa, 'fields.'.$key)) }}">
            </div>
        @endforeach

        <div class="form-group">
            <label class="form-label" for="dj_btn_submit">Teks tombol kirim</label>
            <input id="dj_btn_submit" type="text" name="dj[buttons][submit]" class="form-control" required value="{{ old('dj.buttons.submit', data_get($donasiJasa, 'buttons.submit')) }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="dj_footer_note">Catatan di bawah tombol</label>
            <input id="dj_footer_note" type="text" name="dj[footer_note]" class="form-control" required value="{{ old('dj.footer_note', data_get($donasiJasa, 'footer_note')) }}">
        </div>

        <p style="margin-top:14px;font-size:13px;">
            <a href="{{ route('donasi.jasa') }}" target="_blank" rel="noopener"><i class="fas fa-external-link-alt"></i> Pratinjau halaman publik</a>
        </p>
    </div>
</div>
