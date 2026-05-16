@extends('admin.layouts.app')

@section('title', 'Header situs publik')
@section('page-title', 'Header situs publik')
@section('page-subtitle', 'Logo bar atas, nama merek di samping logo, urutan dan gaya menu (termasuk tombol seperti Donasi)')

@section('content')
@if(session('success'))
    <div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.header-site.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Logo &amp; nama merek</span></div>
        <div class="card-body">
            <p style="font-size:13px;color:var(--gray-600);margin:0 0 14px;line-height:1.55;">
                Logo juga dipakai sebagai favikon tab browser, di footer, dan di panel admin. Teks merek ditampilkan di samping logo di bilah atas (mis. <strong>YPKSSM</strong>).
            </p>
            @if(!empty($siteLogoCmsReady))
                @if($site->site_logo)
                    <div style="margin-bottom:12px;">
                        <img src="{{ \App\Models\SiteContent::siteLogoUrl($site->site_logo) }}" alt="Logo" style="max-height:88px;border-radius:12px;border:1px solid var(--gray-200);background:var(--gray-50);padding:8px;">
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label" for="site_logo">Ubah logo</label>
                    <input id="site_logo" type="file" name="site_logo" class="form-control" accept="image/jpeg,image/png,image/webp,image/gif">
                    @error('site_logo')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                @if($site->site_logo)
                <div class="form-group" style="margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;">
                        <input type="hidden" name="remove_site_logo" value="0">
                        <input type="checkbox" name="remove_site_logo" value="1" {{ old('remove_site_logo') ? 'checked' : '' }}>
                        Hapus logo kustom (kembali ke tanda SS bawaan)
                    </label>
                </div>
                @endif
            @else
                <p style="margin:0;font-size:13px;color:var(--gray-600);">Kolom logo belum ada. Jalankan migrasi terbaru.</p>
            @endif
            <div class="form-group" style="margin-top:14px;margin-bottom:0;">
                <label class="form-label" for="nav_brand_suffix">Teks merek di samping logo</label>
                <input id="nav_brand_suffix" name="nav_brand_suffix" class="form-control" required maxlength="120" value="{{ old('nav_brand_suffix', $site->nav_brand_suffix) }}">
                @error('nav_brand_suffix')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Item menu atas</span></div>
        <div class="card-body">
            <p style="font-size:13px;color:var(--gray-600);margin:0 0 14px;line-height:1.55;">
                Minimal satu item. Aktif/halaman yang sedang dibuka ditandai otomatis di situs. Pilih <em>Tombol menonjol</em> untuk penampilan seperti menu Donasi.
            </p>
            @error('hn.items')<small style="color:#b91c1c;display:block;margin-bottom:10px;">{{ $message }}</small>@enderror
            <p style="font-size:11px;color:var(--gray-500);margin:-8px 0 10px;">Tombol hapus disembunyikan jika hanya ada satu baris.</p>

            <div id="header-rows-items">
                @foreach(($headerNavigationForm['items'] ?? []) as $idx => $row)
                    @continue(! is_array($row))
                    @include('admin.header-site._header-nav-row', ['idx' => $idx, 'row' => $row, 'headerRouteOptions' => $headerRouteOptions])
                @endforeach
            </div>
            <button type="button" id="header-add-item" class="btn btn-secondary btn-sm" style="margin-top:10px;"><i class="fas fa-plus"></i> Tambah item menu</button>

            <template id="tpl-header-nav-row">
                @include('admin.header-site._header-nav-row', [
                    'idx' => '__IDX__',
                    'row' => ['label' => '', 'href_type' => 'route', 'route' => 'home', 'href' => '', 'style' => 'link'],
                    'headerRouteOptions' => $headerRouteOptions,
                ])
            </template>
        </div>
    </div>

    <div class="card" style="margin-bottom:24px;">
        <div class="card-body">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan header</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
        </div>
    </div>
</form>

@push('scripts')
<script>
(function () {
    function syncHeaderHrefUi(row, typeVal) {
        if (!row) return;
        row.querySelectorAll('.header-when-route').forEach(function (el) {
            el.style.display = typeVal === 'route' ? '' : 'none';
        });
        row.querySelectorAll('.header-when-url').forEach(function (el) {
            el.style.display = typeVal === 'url' ? '' : 'none';
        });
    }

    function reindexHeaderRows() {
        var el = document.getElementById('header-rows-items');
        if (!el) return;
        el.querySelectorAll('[data-header-nav-row]').forEach(function (row, index) {
            row.querySelectorAll('[data-field]').forEach(function (fieldEl) {
                var key = fieldEl.getAttribute('data-field');
                if (key) fieldEl.name = 'hn[items][' + index + '][' + key + ']';
            });
        });
        var rows = el.querySelectorAll('[data-header-nav-row]');
        el.querySelectorAll('.header-btn-remove-row').forEach(function (btn) {
            btn.style.display = rows.length <= 1 ? 'none' : '';
        });
    }

    document.getElementById('header-add-item').addEventListener('click', function () {
        var wrap = document.getElementById('header-rows-items');
        var tpl = document.getElementById('tpl-header-nav-row');
        wrap.insertAdjacentHTML('beforeend', tpl.innerHTML.replace(/__IDX__/g, String(wrap.querySelectorAll('[data-header-nav-row]').length)));
        reindexHeaderRows();
        var last = wrap.lastElementChild;
        var sel = last && last.querySelector('select.header-href-type');
        if (sel) syncHeaderHrefUi(last, sel.value);
    });

    document.addEventListener('click', function (e) {
        var rm = e.target.closest('.header-btn-remove-row');
        if (!rm || rm.offsetParent === null) return;
        var row = rm.closest('[data-header-nav-row]');
        var wrap = document.getElementById('header-rows-items');
        if (!row || !wrap || row.parentElement !== wrap) return;
        row.remove();
        reindexHeaderRows();
    });

    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('header-href-type')) {
            syncHeaderHrefUi(e.target.closest('[data-header-nav-row]'), e.target.value);
        }
    });

    document.querySelectorAll('#header-rows-items [data-header-nav-row]').forEach(function (row) {
        var sel = row.querySelector('select.header-href-type');
        if (sel) syncHeaderHrefUi(row, sel.value);
    });
    reindexHeaderRows();
})();
</script>
@endpush
@endsection
