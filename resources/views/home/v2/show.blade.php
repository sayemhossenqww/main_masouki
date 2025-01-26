@extends('layouts.app_v2')


@section('content')
    <div class="my-4">
        <form action="{{ route('home') }}" method="GET" class="search-form">
            <div class="search-input">
                <input type="search" autocomplete="off" name="query" placeholder="Search" value="{{ Request::get('query') }}">
            </div>
            <button type="submit" class="search-button ripple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="24" height="24" style="transform: scaleX(-1);">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form>
    </div>
    @if ($isSearching)
        <div>
            <h2 class="title-search mb-3">SEARCH RESULT:</h2>
            @if ($searchResults->isEmpty())
                <p class="m-0">No result</p>
            @else
                @foreach ($searchResults as $searchResult)
                    <div class="menu-item @if (is_null($searchResult->image_path)) _without-image @endif">
                        @if (!is_null($searchResult->image_path))
                            <img data-src="{{ $searchResult->image_url_v2 }}" alt="{{ $searchResult->name }}"
                                class="lazy img-fluid mb-2" />
                        @endif
                        <h3 class="mb-2">{{ $searchResult->name }}</h3>
                        @if ($searchResult->des)
                            <p>
                                {!! $searchResult->des !!}
                            </p>
                        @endif
                        <div class="menu-item-price">
                            <div class="price">
                                <b>{{ usd_money_format_v2($searchResult->base_price_usd) }}</b>
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <hr>
    @endif

    <div class="d-flex flex-column">
        @foreach ($categories as $category)
            <div class="mb-3">
                <div class="position-relative w-100 overflow-hidden" style="aspect-ratio: 3/1;">
                    <a href="{{ $category->url }}" class="category-link bruvs-link"
                        style="background-image: url({{ $category->image_url_original }});">
                        <h2>{{ $category->name }}</h2>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <home-component-v2></home-component-v2>
@endsection
