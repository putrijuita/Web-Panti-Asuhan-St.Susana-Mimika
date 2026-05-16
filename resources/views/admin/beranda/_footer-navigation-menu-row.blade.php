@php $__idxRaw = isset($idx) ? (string) $idx : '0'; @endphp
<div data-footer-row class="footer-dynamic-row" style="border:1px solid var(--gray-200);border-radius:8px;padding:10px 12px;background:#fff;margin-bottom:10px;">
    <div style="display:flex;justify-content:flex-end;margin-bottom:6px;">
        <button type="button" class="btn btn-outline-danger btn-sm footer-btn-remove-row footer-rows-menu-remove" title="Hapus baris"><i class="fas fa-trash-alt"></i> Hapus</button>
    </div>
    <div class="form-group" style="margin-bottom:10px;">
        <label class="form-label" style="font-size:11px;">Teks tautan di footer</label>
        <input type="text" data-field="label" name="fn[menu_items][{{ $__idxRaw }}][label]" value="{{ is_numeric($idx) ? old('fn.menu_items.'.$idx.'.label', $m['label'] ?? '') : ($m['label'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
        @if(is_numeric($idx))
            @error('fn.menu_items.'.$idx.'.label')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
        @endif
    </div>
    <div class="admin-grid-3">
        <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Jenis tautan</label>
            <select data-field="href_type" name="fn[menu_items][{{ $__idxRaw }}][href_type]" class="form-control footer-href-type" style="font-size:13px;">
                <option value="route" @selected(($m['href_type'] ?? '') === 'route')>Route situs</option>
                <option value="url" @selected(($m['href_type'] ?? '') === 'url')>URL lengkap/path</option>
            </select>
            @if(is_numeric($idx))
                @error('fn.menu_items.'.$idx.'.href_type')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
        <div class="form-group footer-when-route" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Route</label>
            <select data-field="route" name="fn[menu_items][{{ $__idxRaw }}][route]" class="form-control" style="font-size:13px;">
                @foreach($footerRouteOptions as $routeVal => $routeLabel)
                    <option value="{{ $routeVal }}" @selected(($m['route'] ?? '') === $routeVal)>{{ $routeLabel }}</option>
                @endforeach
            </select>
            @if(is_numeric($idx))
                @error('fn.menu_items.'.$idx.'.route')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
        <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Kelas ikon</label>
            <input type="text" data-field="icon" name="fn[menu_items][{{ $__idxRaw }}][icon]" value="{{ is_numeric($idx) ? old('fn.menu_items.'.$idx.'.icon', $m['icon'] ?? '') : ($m['icon'] ?? '') }}" class="form-control" maxlength="120" required style="font-size:13px;">
            @if(is_numeric($idx))
                @error('fn.menu_items.'.$idx.'.icon')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
    </div>
    <div class="form-group footer-when-url" style="margin:8px 0 0;">
        <label class="form-label" style="font-size:11px;">URL manual</label>
        <input type="text" data-field="href" name="fn[menu_items][{{ $__idxRaw }}][href]" value="{{ is_numeric($idx) ? old('fn.menu_items.'.$idx.'.href', $m['href'] ?? '') : ($m['href'] ?? '') }}" class="form-control" maxlength="2000" placeholder="/path atau https://..." style="font-size:13px;">
        @if(is_numeric($idx))
            @error('fn.menu_items.'.$idx.'.href')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
        @endif
    </div>
</div>
