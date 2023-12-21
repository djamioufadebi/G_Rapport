@if ($paginator->hasPages())
<ul class="pagination">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
  <li class="page-item disabled">
    <span class="page-link">{{ __('pagination.previous') }}</span>
  </li>
  @else
  <li class="page-item">
    <button wire:click="previousPage" rel="prev" class="page-link" aria-label="{{ __('pagination.previous') }}">
      {{ __('pagination.previous') }}
    </button>
  </li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
  <li class="page-item">
    <button wire:click="nextPage" rel="next" class="page-link" aria-label="{{ __('pagination.next') }}">
      {{ __('pagination.next') }}
    </button>
  </li>
  @else
  <li class="page-item disabled">
    <span class="page-link">{{ __('pagination.next') }}</span>
  </li>
  @endif
</ul>
@endif
