@if ($paginator->hasPages())
<div style="display:flex;align-items:center;gap:6px;font-size:13px">
    @if ($paginator->onFirstPage())
        <span style="padding:6px 12px;border-radius:6px;border:1px solid var(--gray-200);color:var(--gray-300);cursor:not-allowed">←</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:6px 12px;border-radius:6px;border:1px solid var(--gray-200);color:var(--gray-700);text-decoration:none">←</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:6px 8px;color:var(--gray-400)">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:6px 12px;border-radius:6px;background:var(--brand);color:#fff;font-weight:600">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:6px 12px;border-radius:6px;border:1px solid var(--gray-200);color:var(--gray-700);text-decoration:none">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:6px 12px;border-radius:6px;border:1px solid var(--gray-200);color:var(--gray-700);text-decoration:none">→</a>
    @else
        <span style="padding:6px 12px;border-radius:6px;border:1px solid var(--gray-200);color:var(--gray-300);cursor:not-allowed">→</span>
    @endif

    <span style="color:var(--gray-400);margin-left:8px">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}</span>
</div>
@endif
