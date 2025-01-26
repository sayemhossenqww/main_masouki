@extends('layouts.app')
@section('title', 'About Us | ' . config('app.name'))

@section('header')
    <section class="header-section text-center"
        style="background-image: url('/images/webp/about.webp');background-position: center;">
    </section>
@endsection
@section('content')
    <div class="mb-3 py-3">
        {!! $about !!}
    </div>
@endsection
