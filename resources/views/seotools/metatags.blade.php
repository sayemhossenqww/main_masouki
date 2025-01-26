<title>@yield('title', config('app.meta_title'))</title>
<meta name="keywords" content="@yield('keywords', config('app.keywords'))">
<meta name="description" content="@yield('description', config('app.meta_description'))">
<meta property="fb:app_id" content="{{ config('app.fb_app_id') }}" />
<meta type="metaTags" name="application-name" content="{{ config('app.name') }}" />
<meta type="metaTags" name="mobile-web-app-capable" content="yes" />
