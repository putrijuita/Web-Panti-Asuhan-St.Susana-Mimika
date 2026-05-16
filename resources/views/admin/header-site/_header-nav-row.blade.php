@php $__idxRaw = isset($idx) ? (string) $idx : '0'; @endphp
<div data-header-nav-row class="header-dynamic-row" style="border:1px solid var(--gray-200);border-radius:8px;padding:10px 12px;background:#fff;margin-bottom:10px;">
    <div style="display:flex;justify-content:flex-end;margin-bottom:6px;">
        <button type="button" class="btn btn-outline-danger btn-sm header-btn-remove-row" title="Hapus item"><i class="fas fa-trash-alt"></i> Hapus</button>
    </div>
    <div class="form-group" style="margin-bottom:10px;">
        <label class="form-label" style="font-size:11px;">Teks menu</label>
        <input type="text" data-field="label" name="hn[items][{{ $__idxRaw }}][label]" value="{{ is_numeric($idx) ? old('hn.items.'.$idx.'.label', $row['label'] ?? '') : ($row['label'] ?? '') }}" class="form-control" maxlength="80" required style="font-size:13px;">
        @if(is_numeric($idx))
            @error('hn.items.'.$idx.'.label')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
        @endif
    </div>
    <div class="form-group" style="margin-bottom:10px;">
        <label class="form-label" style="font-size:11px;">Tampilan</label>
        <select data-field="style" name="hn[items][{{ $__idxRaw }}][style]" class="form-control" style="font-size:13px;max-width:280px;">
            <option value="link" @selected(($row['style'] ?? 'link') === 'link')>Tautan biasa</option>
            <option value="cta" @selected(($row['style'] ?? '') === 'cta')>Tombol menonjol (biru)</option>
        </select>
        @if(is_numeric($idx))
            @error('hn.items.'.$idx.'.style')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
        @endif
    </div>
    <div class="admin-grid-3">
        <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Jenis tautan</label>
            <select data-field="href_type" name="hn[items][{{ $__idxRaw }}][href_type]" class="form-control header-href-type" style="font-size:13px;">
                <option value="route" @selected(($row['href_type'] ?? '') === 'route')>Route situs</option>
                <option value="url" @selected(($row['href_type'] ?? '') === 'url')>URL lengkap/path</option>
            </select>
            @if(is_numeric($idx))
                @error('hn.items.'.$idx.'.href_type')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
        <div class="form-group header-when-route" style="margin-bottom:0;">
            <label class="form-label" style="font-size:11px;">Halaman</label>
            <select data-field="route" name="hn[items][{{ $__idxRaw }}][route]" class="form-control" style="font-size:13px;">
                @foreach($headerRouteOptions as $routeVal => $routeLabel)
                    <option value="{{ $routeVal }}" @selected(($row['route'] ?? '') === $routeVal)>{{ $routeLabel }}</option>
                @endforeach
            </select>
            @if(is_numeric($idx))
                @error('hn.items.'.$idx.'.route')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
        <div class="form-group header-when-url" style="margin-bottom:0;display:none;">
            <label class="form-label" style="font-size:11px;">URL</label>
            <input type="text" data-field="href" name="hn[items][{{ $__idxRaw }}][href]" value="{{ is_numeric($idx) ? old('hn.items.'.$idx.'.href', $row['href'] ?? '') : ($row['href'] ?? '') }}" class="form-control" maxlength="2000" style="font-size:13px;" placeholder="https://…">
            @if(is_numeric($idx))
                @error('hn.items.'.$idx.'.href')<small style="color:#b91c1c;display:block">{{ $message }}</small>@enderror
            @endif
        </div>
    </div>
</div>
