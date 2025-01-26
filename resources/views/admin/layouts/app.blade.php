<!DOCTYPE html>
<html lang="pt-BR" dir="ltr" translate="no" data-rh="translate,lang">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="preload" href="{{ mix('css/app-admin.css') }}" as="style" />
    <link rel="stylesheet" href="{{ mix('css/app-admin.css') }}">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @stack('style')
</head>

<body class="pt-a-58 pt-md-a-58">
    <div id="app">
        <div class="d-flex" id="wrapper">
            @include('admin.layouts.sidebar-items')
            <div id="page-content-wrapper">
                @include('admin.layouts.navbar')
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand text-decoration-none">@yield('page_name')</a>
                    </div>
                </nav>
                <div class="container-fluid py-3">

                    @include('alerts.show')
                    @yield('content')
                </div>
            </div>
        </div>
        <back-to-top-component></back-to-top-component>
    </div>


</body>

</html>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/app-admin.js') }}"></script>
@stack('script')
