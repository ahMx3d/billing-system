<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('frontend/globals.app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('frontend/globals.app.name') }}
                </a>
                <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse"
                    id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    {{-- ml-auto --}}
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-primary"
                                href="{{ route('locale.change', 'ar') }}">
                                {{ __('frontend/header.ar') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary"
                                href="{{ route('locale.change', 'en') }}">
                                {{ __('frontend/header.en') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

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
