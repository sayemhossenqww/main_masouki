@extends('layouts.app')
@section('title', $category->name . ' | ' . config('app.meta_title'))
@section('og_image', $category->image_url)
@section('og_url', $category->url)
@section('og_type', $category->name)
@push('head')
    <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/js/swiffy-slider.min.js" crossorigin="anonymous"
        defer></script>
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.5.3/dist/css/swiffy-slider.min.css" rel="stylesheet"
        crossorigin="anonymous">
@endpush
@section('content')

    <div class="py-3 border-bottom">
        <div class="swiffy-slider slider-item-show6 slider-item-reveal slider-item-ratio slider-item-ratio-1x1">
            <ul class="slider-container" style="overflow-y: hidden !important;height: 200px;">
                @foreach ($categories as $cat)
                    <li>
                        <a href="{{ $cat->url }}"
                            class="text-decoration-none @if ($cat->id == $category->id) text-primary fw-bold @else text-black @endif">
                            <img src="{{ $cat->menu_image_url }}" alt="{{ $cat->name }}" class="w-100">
                            <div class="text-break text-center py-2 item-name-content text-uppercase">
                                {{ $cat->name }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <button type="button" class="slider-nav" aria-label="Go left"></button>
            <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>
        </div>
    </div>


    @if (!$items->isEmpty())
        <div class="row py-3">
            @foreach ($items as $item)
                <div class="col-md-4 col-sm-12 d-flex align-items-stretch mb-0 mb-md-3 p-0 px-md-3 mb-md-3">
                    <div class="card card-item rounded-0 w-100 bg-body border">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="item-image-wrapper">
                                    <picture>
                                        <source type="image/jpg" srcset="{{ $item->image_url }}" />
                                        <img alt="{{ $item->name }}" src="{{ $item->image_url }}" aria-hidden="true"
                                            class="item-image" />
                                    </picture>
                                </div>
                            </div>
                            <div class="flex-grow-1 card-body py-0">
                                <span class="text-black fw-bold text-break fs-7">
                                    {{ $item->name }}
                                </span>
                                <div class="text-muted d-none d-md-block fs-7 mb-3">{{ $item->preview_des }}</div>
                                <div class="text-black align-items-center mb-2 fs-7">
                                    {{ $item->view_price_usd }}
                                    @if ($item->has_discount)
                                        <s class="ms-1">
                                            {{ $item->view_original_price_usd }}
                                        </s>
                                        <DiscountBadge styleName="ms-1"></DiscountBadge>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <a href="{{ $item->url }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
@push('script')
    <script>
        const slideArray = [];
        for (let i = 0; i < document.querySelectorAll('.slider div').length; i++) {
            slideArray.push(document.querySelectorAll('.slider div')[i].dataset.background);
        }

        let currentSlideIndex = -1;

        function advanceSliderItem() {
            currentSlideIndex++;

            if (currentSlideIndex >= slideArray.length) {
                currentSlideIndex = 0;
            }
            const sliderElement = document.querySelector('.slider');

            if (sliderElement) {
                sliderElement.style.cssText = 'background: url("' + slideArray[currentSlideIndex] +
                    '") no-repeat center center; background-size: cover;';
            }


            const elems = document.getElementsByClassName('caption');
            for (let i = 0; i < elems.length; i++) {
                elems[i].style.cssText = 'opacity: 0;';
            }

            const currentCaption = document.querySelector('.caption-' + (currentSlideIndex));
            if (currentCaption) {
                currentCaption.style.cssText = 'opacity: 1;';
            }
        }

        let intervalID = setInterval(advanceSliderItem, 3000);
    </script>
@endpush
