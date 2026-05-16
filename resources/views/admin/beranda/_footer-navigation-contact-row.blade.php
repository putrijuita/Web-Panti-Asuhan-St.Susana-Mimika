@php
    $ct = $c['type'] ?? '';
    $__idxRaw = isset($cidx) ? (string) $cidx : '0';
@endphp
<div data-footer-row class="footer-dynamic-row footer-contact-row" style="border:1px solid var(--gray-200);border-radius:8px;padding:10px 12px;background:#fff;margin-bottom:10px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
        <span style="font-size:12px;font-weight:600;color:var(--gray-700);">{{ ($ctHelp[$ct] ?? $ct) }}</span>
        <button type="button" class="btn btn-outline-danger btn-sm footer-btn-remove-row" title="Hapus"><i class="fas fa-trash-alt"></i> Hapus</button>
    </div>

    <input type="hidden" data-field="type" name="fn[contact_items][{{ $__idxRaw }}][type]" value="{{ $ct }}">

    @if(in_array($ct, ['preset_phone', 'preset_fb', 'preset_ig'], true))
        <div class="admin-grid-3">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" style="font-size:11px;">Sumber tautan</label>
                <select data-field="href_type" name="fn[contact_items][{{ $__idxRaw }}][href_type]" class="form-control footer-ct-src" style="font-size:13px;">
                    <option value="site" @selected(($c['href_type'] ?? '') === 'site')>Field CMS (telepon/FB/IG)</option>
                    <option value="route" @selected(($c['href_type'] ?? '') === 'route')>Route situs</option>
                    <option value="url" @selected(($c['href_type'] ?? '') === 'url')>URL manual</option>
                </select>
                @if(is_numeric($cidx))
                    @error('fn.contact_items.'.$cidx.'.href_type')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
                @endif
            </div>
            <div class="form-group footer-ct-route" style="margin-bottom:0;">
                <label class="form-label" style="font-size:11px;">Route</label>
                <select data-field="route" name="fn[contact_items][{{ $__idxRaw }}][route]" class="form-control" style="font-size:13px;">
                    @foreach($footerRouteOptions as $routeVal => $routeLabel)
                        <option value="{{ $routeVal }}" @selected(($c['route'] ?? '') === $routeVal)>{{ $routeLabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" style="font-size:11px;">Kelas ikon</label>
                <input type="text" data-field="icon" name="fn[contact_items][{{ $__idxRaw }}][icon]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.icon', $c['icon'] ?? '') : ($c['icon'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
            </div>
        </div>
        <div class="form-group footer-ct-url" style="margin-top:8px;">
            <label class="form-label" style="font-size:11px;">URL manual</label>
            <input type="text" data-field="href" name="fn[contact_items][{{ $__idxRaw }}][href]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.href', $c['href'] ?? '') : ($c['href'] ?? '') }}" class="form-control" maxlength="2000" style="font-size:13px;">
            @if(is_numeric($cidx))
                @error('fn.contact_items.'.$cidx.'.href')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
    @elseif($ct === 'preset_address')
        <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Kelas ikon alamat</label>
            <input type="text" data-field="icon" name="fn[contact_items][{{ $__idxRaw }}][icon]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.icon', $c['icon'] ?? '') : ($c['icon'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
            @if(is_numeric($cidx))
                @error('fn.contact_items.'.$cidx.'.icon')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
    @elseif($ct === 'custom_link')
        <div class="admin-grid-2">
            <div class="form-group" style="margin-bottom:8px;">
                <label class="form-label" style="font-size:11px;">Label</label>
                <input type="text" data-field="label" name="fn[contact_items][{{ $__idxRaw }}][label]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.label', $c['label'] ?? '') : ($c['label'] ?? '') }}" class="form-control" maxlength="200" required style="font-size:13px;">
            </div>
            <div class="form-group" style="margin-bottom:8px;">
                <label class="form-label" style="font-size:11px;">URL</label>
                <input type="text" data-field="url" name="fn[contact_items][{{ $__idxRaw }}][url]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.url', $c['url'] ?? '') : ($c['url'] ?? '') }}" class="form-control" maxlength="500" required style="font-size:13px;">
            </div>
        </div>
        <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Kelas ikon</label>
            <input type="text" data-field="icon" name="fn[contact_items][{{ $__idxRaw }}][icon]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.icon', $c['icon'] ?? '') : ($c['icon'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
        </div>
    @elseif($ct === 'custom_plain')
        <div class="form-group" style="margin-bottom:8px;">
            <label class="form-label" style="font-size:11px;">Teks</label>
            <textarea data-field="body" name="fn[contact_items][{{ $__idxRaw }}][body]" rows="3" maxlength="500" class="form-control" required>{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.body', $c['body'] ?? '') : ($c['body'] ?? '') }}</textarea>
        </div>
        <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Kelas ikon</label>
            <input type="text" data-field="icon" name="fn[contact_items][{{ $__idxRaw }}][icon]" value="{{ is_numeric($cidx) ? old('fn.contact_items.'.$cidx.'.icon', $c['icon'] ?? '') : ($c['icon'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
        </div>
    @endif
</div>
