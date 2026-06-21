<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Meta -->
    @if(isset($page['props']['meta']) || isset($page['props']['defaultMeta']))
    <title>{{ data_get($page['props'], 'meta.title', data_get($page['props'], 'defaultMeta.title')) }}</title>
    <link rel="icon" type="image/png" href="{{ data_get($page['props'], 'meta.favicon', data_get($page['props'], 'defaultMeta.favicon')) }}" />

    <meta name="description" content="{{ data_get($page['props'], 'meta.description', data_get($page['props'], 'defaultMeta.description')) }}" />
    <link rel="canonical" href="{{ data_get($page['props'], 'meta.url', data_get($page['props'], 'defaultMeta.url')) }}" />

    <meta property="og:title" content="{{ data_get($page['props'], 'meta.title', data_get($page['props'], 'defaultMeta.title')) }}" />
    <meta property="og:description" content="{{ data_get($page['props'], 'meta.description', data_get($page['props'], 'defaultMeta.description')) }}" />
    <meta property="og:image" content="{{ data_get($page['props'], 'meta.image', data_get($page['props'], 'defaultMeta.image')) }}" />
    <meta property="og:url" content="{{ data_get($page['props'], 'meta.url', data_get($page['props'], 'defaultMeta.url')) }}" />
    <meta property="og:type" content="website" />

    <meta name="twitter:title" content="{{ data_get($page['props'], 'meta.title', data_get($page['props'], 'defaultMeta.title')) }}" />
    <meta name="twitter:description" content="{{ data_get($page['props'], 'meta.description', data_get($page['props'], 'defaultMeta.description')) }}" />
    <meta name="twitter:image" content="{{ data_get($page['props'], 'meta.image', data_get($page['props'], 'defaultMeta.image')) }}" />
    <meta name="twitter:card" content="summary_large_image" />
    @endif

    <!-- Voltz template styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    <!-- RSS Feed -->
    @include('feed::links')

    @vite(['resources/css/app.css','resources/js/app.ts'])
    @routes
    @inertiaHead
</head>
<body>
    <!-- jQuery first so Voltz plugins are ready before Vue mounts -->
    <script src="{{ asset('assets/js/plugins/jquery-3-7-1.min.js') }}"></script>

    @inertia

    <!-- Voltz template scripts -->
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fontawesome.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/aos.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counter.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sidebar.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick-slider.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper-slider.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
