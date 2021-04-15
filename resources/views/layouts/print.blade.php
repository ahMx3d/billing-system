<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ __('frontend/globals.app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch"
        href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito"
        rel="stylesheet">

    <!-- assets -->
    <link rel="stylesheet"
        href="{{ asset('vendor/css/fontawesome/all.min.css') }}" />
    @if (config('app.locale') == 'ar')
        <link rel="stylesheet"
            href="{{ asset('vendor/css/bootstrap-rtl.css') }}" />
    @endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"
        rel="stylesheet">
    @yield('style')
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                @include('partials.flash')
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- assets -->
    <script src="{{ asset('vendor/js/fontawesome/all.min.js') }}"></script>
    <script>
        $(() => {
            $('#session-alert').fadeTo(2000, 500).slideUp(500, () => {
                $(this).slideUp(500);
            })
        })

    </script>
    @yield('script')
</body>

</html>
