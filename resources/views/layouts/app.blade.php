<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.dir') }}" translate="{{ config('app.translate') }}">

<head>

    @production
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.gtag') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', "{{ config('app.gtag') }}");
        </script>
        <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />
    @endproduction
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#46210d">
    <meta name="msapplication-TileColor" content="#441b05">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
    @include('seotools.metatags')
    @include('seotools.opengraph')
    @include('seotools.twitter')
    @include('seotools.json-ld')
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @stack('style')
    @stack('head')
</head>
@php
    $isHomeRoute = Route::currentRouteName() == 'home';
@endphp

<body class="padding-top-55">

    <div id="app">
        @include('layouts.navbar')
        @include('layouts.sidebar-items')
        @includeWhen($isHomeRoute, 'layouts.info-navbar')
        @yield('header')
        @includeWhen($isHomeRoute, 'layouts.global-alert')
        @includeWhen($isHomeRoute, 'layouts.carousel')
        <div class="@if ($isHomeRoute) container-fluid  @else container @endif py-2">
            @yield('content')
        </div>
        @include('layouts.footer')
        <back-to-top-component></back-to-top-component>
    </div>
    {{-- @include('layouts.snow') --}}
</body>

</html>
<script defer src="{{ mix('js/app.js') }}"></script>
@stack('script')
