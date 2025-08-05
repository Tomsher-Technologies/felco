<!DOCTYPE html>
<html lang="{{ getActiveLanguage() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {!! SEO::generate() !!}

    <link rel="canonical" href="{{ request()->url() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}" />

    <!-- Mona Sans font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

    <!-- Google Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('header')
</head>

<body class="font-sans bg-white text-gray-900">
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <div id="app" class="page-wrapper">
                @include('frontend.parts.header')

                @yield('content')

                @include('frontend.parts.footer')
            </div>
        </div>
    </div>

    @yield('script')
</body>
</html>
