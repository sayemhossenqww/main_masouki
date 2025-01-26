{{-- <meta name="twitter:card" content="summary_large_image" /> --}}
<meta name="twitter:description" content="@yield('description', config('app.meta_description'))" />
<meta name="twitter:title" content="@yield('title', config('app.meta_title'))" />
<meta name="twitter:image" content="@yield('og_image', asset('share.png'))" />
<meta name="twitter:site" content="@{{ config('app.twitter_username') }}" />
<meta name="twitter:creator" content="{{ config('app.domain') }}" />
<meta name="twitter:image:alt" content="@yield('title', config('app.name'))" />
