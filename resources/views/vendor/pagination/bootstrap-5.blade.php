@if ($paginator->hasPages())
<div class="clearfix">
  <div class="hint-text">Showing <b>{{ $paginator->firstItem() }}</b> to <b>{{ $paginator->lastItem() }}</b> out of <b>{{ $paginator->total() }}</b> entries</div>
  <ul class="pagination">
    {{-- Previous Page Link --}}
    @if (!$paginator->onFirstPage())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
      <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
          @else
          <li class="page-item"><a class="page-link" href="{{ $url.'&'.http_build_query(request()->except('page')) }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
    </li>
    @endif
  </ul>
</div>
@endif