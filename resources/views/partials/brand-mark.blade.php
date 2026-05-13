@php
    use App\Models\SiteContent;
    $resolved = SiteContent::resolved();
    $cmsLogoUrl = SiteContent::siteLogoUrl(data_get($resolved, 'site_logo'));
    $logoPath = config('branding.logo_path');
    $envLogoUrl = ($logoPath !== '' && $logoPath !== null && file_exists(public_path($logoPath))) ? asset($logoPath) : null;
    $logoUrl = $cmsLogoUrl ?? $envLogoUrl;
    $variant = $variant ?? 'nav';
    $size = $variant === 'footer' ? 40 : ($variant === 'compact' ? 36 : 38);
@endphp
@if (filled($logoUrl))
    <img src="{{ $logoUrl }}" alt="Panti Asuhan Santa Susana Timika" class="brand-mark-img brand-mark-img--{{ $variant }}" width="{{ $size }}" height="{{ $size }}" style="width:{{ $size }}px;height:{{ $size }}px;object-fit:contain;border-radius:8px;">
@else
    <span class="brand-mark-fallback brand-mark-fallback--{{ $variant }}" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="{{ $size }}" height="{{ $size }}" viewBox="0 0 40 40" fill="none">
            <rect width="40" height="40" rx="10" fill="currentColor" opacity="0.12"/>
            <text x="20" y="26" text-anchor="middle" font-family="Georgia, 'Times New Roman', serif" font-size="13" font-weight="700" fill="currentColor">SS</text>
        </svg>
    </span>
@endif
