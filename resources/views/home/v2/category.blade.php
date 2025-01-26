@extends('layouts.app_v2')
@section('title', $category->name . ' | ' . config('app.meta_title'))
@section('og_image', $category->image_url)
@section('og_url', $category->url)
@section('og_type', $category->name)

@section('content')
    <h3 class="category-name">{{ $category->name }}</h3>

    @foreach ($items as $item)
        <div class="menu-item @if (is_null($item->image_path)) _without-image @endif">
                <a href="{{ $item->url }}">
                    <img data-src="{{ $item->image_url_v2 }}" alt="{{ $item->name }}" class="lazy img-fluid mb-2" />
                </a>
            <h3 class="mb-2">{{ $item->name }}</h3>
            <p>
                {!! $item->des !!}
            </p>
            <div class="menu-item-price">
                <div class="price">
                    <b>{{ usd_money_format_v2($item->base_price_usd) }}</b>
                    <span>$</span>
                </div>
            </div>
        </div>
    @endforeach

@endsection
