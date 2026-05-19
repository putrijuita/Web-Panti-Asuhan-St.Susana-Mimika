@php
    $cmsFileUrl = $url ?? null;
    $cmsFilePath = $path ?? null;
    $cmsFileLabel = $label ?? 'File saat ini';
    $cmsFileCaption = $caption ?? null;
    $cmsFileType = $type ?? null;
    $cmsMaxWidth = $maxWidth ?? '280px';
    $cmsMaxHeight = $maxHeight ?? '160px';
    $cmsEmptyText = $emptyText ?? null;

    if (! $cmsFileType && filled($cmsFileUrl)) {
        $ext = strtolower(pathinfo(parse_url((string) $cmsFileUrl, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));
        $cmsFileType = in_array($ext, ['mp4', 'mov', 'webm', 'avi', 'mkv'], true) ? 'video'
            : (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'], true) ? 'image' : 'file');
    }

    $cmsHasPreview = filled($cmsFileUrl) || filled($cmsFilePath);
@endphp

@if($cmsHasPreview || filled($cmsEmptyText))
    <div class="cms-current-file" style="margin-bottom:12px;padding:12px 14px;background:var(--gray-50);border:1px solid var(--gray-200);border-radius:10px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:var(--gray-500);margin-bottom:8px;">{{ $cmsFileLabel }}</div>
        @if(filled($cmsFileCaption))
            <p style="font-size:12px;color:var(--gray-600);margin:0 0 8px;line-height:1.45;">{{ $cmsFileCaption }}</p>
        @endif
        @if(filled($cmsFileUrl) && $cmsFileType === 'image')
            <img src="{{ $cmsFileUrl }}" alt="" style="display:block;max-width:{{ $cmsMaxWidth }};max-height:{{ $cmsMaxHeight }};width:auto;height:auto;object-fit:contain;border-radius:8px;border:1px solid var(--gray-200);background:#fff;">
        @elseif(filled($cmsFileUrl) && $cmsFileType === 'video')
            <video src="{{ $cmsFileUrl }}" controls style="display:block;max-width:{{ $cmsMaxWidth }};max-height:{{ $cmsMaxHeight }};border-radius:8px;border:1px solid var(--gray-200);background:#000;"></video>
        @elseif(filled($cmsFileUrl))
            <a href="{{ $cmsFileUrl }}" target="_blank" rel="noopener" style="font-size:13px;font-weight:600;color:var(--primary);word-break:break-all;">
                <i class="fas fa-external-link-alt"></i> Buka file
            </a>
        @elseif(filled($cmsEmptyText))
            <p style="font-size:13px;color:var(--gray-600);margin:0;line-height:1.45;">{{ $cmsEmptyText }}</p>
        @endif
        @if(filled($cmsFilePath))
            <div style="margin-top:8px;font-size:12px;color:var(--gray-600);word-break:break-all;">
                <i class="fas fa-file" style="opacity:0.7;margin-right:4px;"></i>
                <code style="background:#fff;padding:2px 6px;border-radius:4px;border:1px solid var(--gray-200);">{{ str_starts_with($cmsFilePath, 'http') ? $cmsFilePath : basename($cmsFilePath) }}</code>
            </div>
        @endif
    </div>
@endif
