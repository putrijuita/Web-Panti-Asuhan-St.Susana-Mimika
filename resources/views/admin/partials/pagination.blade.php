@if ($paginator->hasPages())
<nav style="display:flex;gap:4px;align-items:center;">
    @if ($paginator->onFirstPage())
        <span style="padding:5px 10px;border:1px solid #e2e8f0;border-radius:6px;color:#cbd5e1;font-size:12px;">
            <i class="fas fa-chevron-left"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:5px 10px;border:1px solid #e2e8f0;border-radius:6px;color:#475569;font-size:12px;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background=''">
            <i class="fas fa-chevron-left"></i>
        </a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:5px 8px;color:#94a3b8;font-size:12px;">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:5px 10px;border:1px solid #1e40af;border-radius:6px;background:#1e40af;color:#fff;font-size:12px;font-weight:600;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:5px 10px;border:1px solid #e2e8f0;border-radius:6px;color:#475569;font-size:12px;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background=''">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:5px 10px;border:1px solid #e2e8f0;border-radius:6px;color:#475569;font-size:12px;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background=''">
            <i class="fas fa-chevron-right"></i>
        </a>
    @else
        <span style="padding:5px 10px;border:1px solid #e2e8f0;border-radius:6px;color:#cbd5e1;font-size:12px;">
            <i class="fas fa-chevron-right"></i>
        </span>
    @endif
</nav>
@endif
