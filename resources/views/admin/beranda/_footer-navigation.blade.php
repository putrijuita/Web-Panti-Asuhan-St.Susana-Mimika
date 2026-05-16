@if(!empty($footerNavigationCmsReady))
        <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.35rem 0 1rem;">
        <p style="font-size:13px;color:var(--gray-600);margin:0 0 12px;line-height:1.45;">
            <strong>Route &amp; ikon footer (dinamis).</strong> Setiap baris dapat ditambah atau dihapus. Isi teks telepon, Facebook, Instagram, dan URL ikon sosial di field di atas; kolom menu di sini memiliki <em>label tersendiri</em> untuk tampilan footer (bukan untuk menu navigasi atas).
        </p>
        <details open style="border:1px solid var(--gray-200);border-radius:10px;background:var(--gray-50);padding:12px 14px;margin-bottom:12px;">
            <summary style="cursor:pointer;font-weight:600;font-size:13px;color:var(--gray-700);outline:none;">
                Panduan cepat Font Awesome (klasik)
            </summary>
            <div style="font-size:12px;color:var(--gray-600);margin-top:10px;line-height:1.5;">
                Chevron: <code style="background:#eef2ff;padding:2px 6px;border-radius:4px;">fas fa-chevron-right fa-xs</code> —
                sosial: <code>fab fa-facebook-f</code>, <code>fas fa-phone</code>, <code>fab fa-instagram</code> —
                kontak: <code>fas fa-phone fa-sm</code>, <code>fab fa-instagram fa-sm</code>, <code>fas fa-location-dot fa-sm</code>.
            </div>
        </details>


        <h5 style="font-size:12px;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-500);margin:14px 0 8px;">Kolom MENU (footer)</h5>
        <p style="font-size:11px;color:var(--gray-500);margin:-2px 0 8px;">Minimal satu baris. Tombol hapus tersembunyi jika hanya ada satu.</p>
        <div id="footer-rows-menu" data-footer-section="footer-rows-menu">
            @foreach(($footerNavigationForm['menu_items'] ?? []) as $idx => $m)
                @continue(! is_array($m))
                @include('admin.beranda._footer-navigation-menu-row', [
                    'idx' => $idx,
                    'm' => $m,
                    'footerRouteOptions' => $footerRouteOptions,
                ])
            @endforeach
        </div>
        <button type="button" id="footer-add-menu" class="btn btn-secondary btn-sm" style="margin-top:10px;"><i class="fas fa-plus"></i> Tambah tautan menu</button>

        <h5 style="font-size:12px;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-500);margin:22px 0 8px;">Kolom {{ $site->footer_heading_kegiatan ?? 'KEGIATAN' }}</h5>
        <p style="font-size:11px;color:var(--gray-500);margin:-2px 0 8px;">Opsional — boleh kosong.</p>
        <div id="footer-rows-kegiatan" data-footer-section="footer-rows-kegiatan">
            @foreach(($footerNavigationForm['kegiatan_items'] ?? []) as $idx => $kj)
                @continue(! is_array($kj))
                @include('admin.beranda._footer-navigation-kegiatan-row', [
                    'idx' => $idx,
                    'kj' => $kj,
                    'footerRouteOptions' => $footerRouteOptions,
                ])
            @endforeach
        </div>
        <button type="button" id="footer-add-kegiatan" class="btn btn-secondary btn-sm" style="margin-top:10px;"><i class="fas fa-plus"></i> Tambah tautan</button>

        <h5 style="font-size:12px;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-500);margin:22px 0 8px;">Baris ikon sosial (kecil)</h5>
        <p style="font-size:11px;color:var(--gray-500);margin:-2px 0 8px;">Setiap ikon berikut URL lengkapnya (biasanya sama dengan field URL sosial di atas).</p>
        <div id="footer-rows-social" data-footer-section="footer-rows-social">
            @foreach(($footerNavigationForm['social_items'] ?? []) as $sidx => $s)
                @continue(! is_array($s))
                <div data-footer-row class="footer-dynamic-row">
                    <div style="display:flex;justify-content:flex-end;margin-bottom:6px;">
                        <button type="button" class="btn btn-outline-danger btn-sm footer-btn-remove-row" title="Hapus baris"><i class="fas fa-trash-alt"></i> Hapus</button>
                    </div>
                    <div class="admin-grid-3">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">URL</label>
                            <input type="text" data-field="url" name="fn[social_items][{{ $sidx }}][url]" value="{{ old('fn.social_items.'.$sidx.'.url', $s['url'] ?? '') }}" class="form-control" maxlength="500" required style="font-size:13px;">
                            @error('fn.social_items.'.$sidx.'.url')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">Title / tooltip</label>
                            <input type="text" data-field="title" name="fn[social_items][{{ $sidx }}][title]" value="{{ old('fn.social_items.'.$sidx.'.title', $s['title'] ?? '') }}" class="form-control" maxlength="80" required style="font-size:13px;">
                            @error('fn.social_items.'.$sidx.'.title')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" style="font-size:11px;">Kelas ikon</label>
                            <input type="text" data-field="icon" name="fn[social_items][{{ $sidx }}][icon]" value="{{ old('fn.social_items.'.$sidx.'.icon', $s['icon'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
                            @error('fn.social_items.'.$sidx.'.icon')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="footer-add-social" class="btn btn-secondary btn-sm" style="margin-top:10px;"><i class="fas fa-plus"></i> Tambah ikon sosial</button>

        @php $__ctHelp = ['preset_phone' => 'Telepon — teks/link dari field kontak', 'preset_fb' => 'Facebook — dari field CMS', 'preset_ig' => 'Instagram — dari CMS', 'preset_address' => 'Alamat — teks dari field alamat footer', 'custom_link' => 'Tautan kustom — isi URL + label manual', 'custom_plain' => 'Teks biasa']; @endphp
        <h5 style="font-size:12px;text-transform:uppercase;letter-spacing:0.08em;color:var(--gray-500);margin:22px 0 8px;">Kolom kontak</h5>
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:8px;">
            @foreach (\App\Models\SiteContent::footerContactItemTypes() as $__ctAdd)
                <button type="button" class="btn btn-secondary btn-sm footer-add-contact" data-contact-type="{{ $__ctAdd }}"><i class="fas fa-plus"></i> {{ $__ctHelp[$__ctAdd] ?? $__ctAdd }}</button>
            @endforeach
        </div>
        <div id="footer-rows-contact" data-footer-section="footer-rows-contact">
            @foreach(($footerNavigationForm['contact_items'] ?? []) as $cidx => $c)
                @continue(! is_array($c))
                @include('admin.beranda._footer-navigation-contact-row', [
                    'cidx' => $cidx,
                    'c' => $c,
                    'footerRouteOptions' => $footerRouteOptions,
                    'ctHelp' => $__ctHelp,
                ])
            @endforeach
        </div>

        <template id="tpl-footer-menu-row">
            @include('admin.beranda._footer-navigation-menu-row', [
                'idx' => '__IDX__',
                'm' => ['label'=>'','href_type'=>'route','route'=>'home','href'=>'','icon'=>'fas fa-chevron-right fa-xs'],
                'footerRouteOptions' => $footerRouteOptions,
            ])
        </template>
        <template id="tpl-footer-kegiatan-row">
            @include('admin.beranda._footer-navigation-kegiatan-row', [
                'idx' => '__IDX__',
                'kj' => ['label'=>'','href_type'=>'route','route'=>'program','href'=>'','icon'=>'fas fa-chevron-right fa-xs'],
                'footerRouteOptions' => $footerRouteOptions,
            ])
        </template>
        <template id="tpl-footer-social-row">
            <div data-footer-row class="footer-dynamic-row">
                <div style="display:flex;justify-content:flex-end;margin-bottom:6px;">
                    <button type="button" class="btn btn-outline-danger btn-sm footer-btn-remove-row" title="Hapus baris"><i class="fas fa-trash-alt"></i> Hapus</button>
                </div>
                <div class="admin-grid-3">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">URL</label>
                        <input type="text" data-field="url" class="form-control" maxlength="500" required style="font-size:13px;">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Title</label>
                        <input type="text" data-field="title" class="form-control" maxlength="80" required style="font-size:13px;">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" style="font-size:11px;">Kelas ikon</label>
                        <input type="text" data-field="icon" class="form-control" maxlength="120" required style="font-size:13px;">
                    </div>
                </div>
            </div>
        </template>
        @foreach (\App\Models\SiteContent::footerContactItemTypes() as $__tplCt)
            <template id="tpl-footer-contact-{{ $__tplCt }}">
                @include('admin.beranda._footer-navigation-contact-row', [
                    'cidx' => '__IDX__',
                    'c' => match ($__tplCt) {
                        'preset_phone' => ['type' => 'preset_phone', 'href_type' => 'site', 'route' => '', 'href' => '', 'icon' => 'fas fa-phone fa-sm'],
                        'preset_fb' => ['type' => 'preset_fb', 'href_type' => 'site', 'route' => '', 'href' => '', 'icon' => 'fab fa-facebook-f fa-sm'],
                        'preset_ig' => ['type' => 'preset_ig', 'href_type' => 'site', 'route' => '', 'href' => '', 'icon' => 'fab fa-instagram fa-sm'],
                        'preset_address' => ['type' => 'preset_address', 'icon' => 'fas fa-location-dot fa-sm'],
                        'custom_link' => ['type' => 'custom_link', 'label' => '', 'url' => '', 'icon' => 'fas fa-link fa-sm'],
                        'custom_plain' => ['type' => 'custom_plain', 'body' => '', 'icon' => 'fas fa-info-circle fa-sm'],
                        default => ['type' => $__tplCt, 'icon' => 'fas fa-link'],
                    },
                    'footerRouteOptions' => $footerRouteOptions,
                    'ctHelp' => $__ctHelp,
                ])
            </template>
        @endforeach

        @push('scripts')
        <script>
        (function () {
            function syncHrefTypeUi(row, typeVal) {
                if (! row) return;
                row.querySelectorAll('.footer-when-route').forEach(function (el) {
                    el.style.display = typeVal === 'route' ? '' : 'none';
                });
                row.querySelectorAll('.footer-when-url').forEach(function (el) {
                    el.style.display = typeVal === 'url' ? '' : 'none';
                });
            }

            function syncContactSrc(row, v) {
                if (! row) return;
                row.querySelectorAll('.footer-ct-route').forEach(function (el) {
                    el.style.display = v === 'route' ? '' : 'none';
                });
                row.querySelectorAll('.footer-ct-url').forEach(function (el) {
                    el.style.display = v === 'url' ? '' : 'none';
                });
            }

            function reindexRows(containerId, segment) {
                var el = document.getElementById(containerId);
                if (! el) return;
                el.querySelectorAll('[data-footer-row]').forEach(function (row, index) {
                    row.querySelectorAll('[data-field]').forEach(function (fieldEl) {
                        var key = fieldEl.getAttribute('data-field');
                        if (key) {
                            fieldEl.name = 'fn[' + segment + '][' + index + '][' + key + ']';
                        }
                    });
                });
                if (segment === 'menu_items') {
                    var rows = el.querySelectorAll('[data-footer-row]');
                    el.querySelectorAll('.footer-rows-menu-remove').forEach(function (btn) {
                        btn.style.display = rows.length <= 1 ? 'none' : '';
                    });
                }
            }

            function refreshAllUi() {
                var map = { menu_items: 'footer-rows-menu', kegiatan_items: 'footer-rows-kegiatan', social_items: 'footer-rows-social', contact_items: 'footer-rows-contact' };
                Object.keys(map).forEach(function (segment) {
                    reindexRows(map[segment], segment);
                });
                document.querySelectorAll('select.footer-href-type').forEach(function (s) {
                    syncHrefTypeUi(s.closest('[data-footer-row]'), s.value);
                });
                document.querySelectorAll('select.footer-ct-src').forEach(function (s) {
                    syncContactSrc(s.closest('[data-footer-row]'), s.value);
                });
            }

            document.getElementById('footer-add-menu').addEventListener('click', function () {
                var wrap = document.getElementById('footer-rows-menu');
                var tpl = document.getElementById('tpl-footer-menu-row');
                wrap.insertAdjacentHTML('beforeend', tpl.innerHTML.replace(/__IDX__/g, String(wrap.querySelectorAll('[data-footer-row]').length)));
                reindexRows('footer-rows-menu', 'menu_items');
                refreshAllUi();
            });

            document.getElementById('footer-add-kegiatan').addEventListener('click', function () {
                var wrap = document.getElementById('footer-rows-kegiatan');
                var tpl = document.getElementById('tpl-footer-kegiatan-row');
                wrap.insertAdjacentHTML('beforeend', tpl.innerHTML.replace(/__IDX__/g, String(wrap.querySelectorAll('[data-footer-row]').length)));
                reindexRows('footer-rows-kegiatan', 'kegiatan_items');
                refreshAllUi();
            });

            document.getElementById('footer-add-social').addEventListener('click', function () {
                var wrap = document.getElementById('footer-rows-social');
                var tpl = document.getElementById('tpl-footer-social-row');
                var node = tpl.content.firstElementChild.cloneNode(true);
                wrap.appendChild(node);
                reindexRows('footer-rows-social', 'social_items');
            });

            document.querySelectorAll('.footer-add-contact').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var type = btn.getAttribute('data-contact-type');
                    var tpl = document.getElementById('tpl-footer-contact-' + type);
                    if (! tpl) return;
                    var wrap = document.getElementById('footer-rows-contact');
                    wrap.insertAdjacentHTML('beforeend', tpl.innerHTML.replace(/__IDX__/g, String(wrap.querySelectorAll('[data-footer-row]').length)));
                    reindexRows('footer-rows-contact', 'contact_items');
                    refreshAllUi();
                });
            });

            document.addEventListener('click', function (e) {
                var rm = e.target.closest('.footer-btn-remove-row');
                if (! rm) return;
                var row = rm.closest('[data-footer-row]');
                var section = row && row.parentElement;
                if (! row || ! section || ! section.id) return;
                row.remove();
                var sid = section.id;
                if (sid === 'footer-rows-menu') reindexRows('footer-rows-menu', 'menu_items');
                else if (sid === 'footer-rows-kegiatan') reindexRows('footer-rows-kegiatan', 'kegiatan_items');
                else if (sid === 'footer-rows-social') reindexRows('footer-rows-social', 'social_items');
                else if (sid === 'footer-rows-contact') reindexRows('footer-rows-contact', 'contact_items');
                refreshAllUi();
            });

            document.addEventListener('change', function (e) {
                if (e.target.classList.contains('footer-href-type')) {
                    syncHrefTypeUi(e.target.closest('[data-footer-row]'), e.target.value);
                }
                if (e.target.classList.contains('footer-ct-src')) {
                    syncContactSrc(e.target.closest('[data-footer-row]'), e.target.value);
                }
            });

            refreshAllUi();
        })();
        </script>
        @endpush
@else
        <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0 1rem;">
        <div style="font-size:13px;color:var(--gray-600);margin:0;padding:12px;background:var(--gray-50);border-radius:10px;line-height:1.5;">
            Jalankan migrasi kolom <code>footer_navigation</code> untuk mengaktifkan pengaturan route &amp; ikon footer dari CMS.
        </div>
@endif
