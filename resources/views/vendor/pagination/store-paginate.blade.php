@if ($paginator->hasPages())
<div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            <ul>
                @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <a href="#">&lt;</a>
                </li>
                @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">&lt;</a>
                </li>
                @endif
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
                @else
                <li class="disabled" aria-disabled="true">
                    <a href="#">&gt;</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endif
