@if ($paginator->hasPages())
    <div class="tp-shop-pagination mt-20">
        <div class="tp-pagination">
            <nav>
                <ul>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li>
                            <a href="shop.html" class="tp-pagination-prev prev page-numbers">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}" class="tp-pagination-prev prev page-numbers">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span class="current">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li>
                                        <span class="current">{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}" class="next page-numbers">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="shop.html" class="next page-numbers">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
