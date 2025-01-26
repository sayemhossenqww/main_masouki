@extends('layouts.app')
@section('title', $item->name . ' | ' . config('app.meta_title'))
@section('description', $item->meta_description)
@section('keywords', $item->meta_keywords)
@section('og_image', $item->image_url)
@section('og_url', $item->url)
@section('og_type', $item->category->name)
@push('head')
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=62580719eb843b00192d12e2&product=sop'
        async='async'></script>
@endpush
@section('content')

    <div class="row py-2 mb-3">
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="modal-item-image-wrapper">
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                    class="w-100 h-100 object-fit-cover rounded-main" />
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mb-3 px-lg-5">
            <h1 class="text-dark fw-bolder mb-3 font-cinzel text-break">
                {{ $item->name }}
            </h1>
            <div class="mb-3">
                {!! $item->des !!}
            </div>
            <div class="mb-3">
                <property-badge-component :item="{{ $item }}"></property-badge-component>
            </div>
            <hr>
            <div class="mb-3">
                @if ($item->active)
                    <item-cart-component :item="{{ $item }}" />
                @else
                    <div class="text-center h3 fw-bold">Item not available at this time</div>
                @endif
            </div>
            <hr>
            <div class="mb-3">
                <h6 class="text-center fw-bolder mb-3">TELL YOUR FRIENDS ABOUT THIS OFFER</h6>
                <div class="sharethis-inline-share-buttons"></div>
            </div>

        </div>

    </div>
  
    @if (!$similarItems->isEmpty())
    <div class="row">
        <div class="text-black fw-bold h4 px-3">Similar Items</div>
        @foreach ($similarItems as $similarItems)
            <div class="col-md-6 col-sm-12 d-flex align-items-stretch mb-0 mb-md-3 p-0 px-md-3">
                <div class="card card-item rounded-0 w-100 bg-body border">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="item-image-wrapper">
                                <picture>
                                    <source type="image/jpg" srcset="{{ $similarItems->image_url }}" />
                                    <img alt="{{ $similarItems->name }}" src="{{ $similarItems->image_url }}"
                                        aria-hidden="true" class="item-image rounded-0" />
                                </picture>
                            </div>
                        </div>
                        <div class="flex-grow-1 card-body py-0">
                            <span class="text-black fw-bold text-break fs-7">
                                {{ $similarItems->name }}
                                @if ($similarItems->is_vegan)
                                    <Icon icon="leaf" styleName="me-1"></Icon>
                                @endif
                                @if ($similarItems->is_vegetarian)
                                    <Icon icon="leaf_right" styleName="me-1"></Icon>
                                @endif
                                @if ($similarItems->is_gluten_free)
                                    <Icon icon="gluten_free" styleName="me-1"></Icon>
                                @endif
                                @if ($similarItems->is_spicy)
                                    <Icon icon="chili" styleName="me-1"></Icon>
                                @endif
                                @if ($similarItems->is_low_carb)
                                    <Icon icon="leaves" styleName="me-1"></Icon>
                                @endif
                                @if ($similarItems->is_sugar_free)
                                    <Icon icon="sugar_free" styleName="me-1"></Icon>
                                @endif
                                @if ($similarItems->is_lactose_free)
                                    <Icon icon="lactose_free" styleName="me-1"></Icon>
                                @endif
                            </span>

                            <div class="text-muted d-none d-md-block fs-7 mb-3">{{ $similarItems->preview_des }}</div>
                            <div class="text-black align-items-center mb-2 fs-7">
                                {{ $similarItems->view_price_usd }}
                                @if ($similarItems->has_discount)
                                    <s class="ms-1">
                                        {{ $similarItems->view_original_price_usd }}
                                    </s>
                                    <DiscountBadge styleName="ms-1"></DiscountBadge>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="{{ $similarItems->url }}" class="stretched-link"></a>
                </div>
            </div>
        @endforeach

    </div>
    @endif

@endsection