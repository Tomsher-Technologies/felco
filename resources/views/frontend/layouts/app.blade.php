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

    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet" />

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Additional CSS and JS assets -->
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-BHpbEy6Y.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-B9igcZhZ.css') }}" />
    <script src="{{ asset('build/assets/app-DB82gzYu.js') }}" defer></script> --}}

    <!-- Vite Assets -->


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('header')
</head>

<body>
  <div id="smooth-wrapper">
    @include('frontend.parts.header')   <!-- Sticky Header outside smooth-content -->
    <div id="smooth-content">            <!-- Scroll container -->
      <div id="app" class="page-wrapper">
        @yield('content')
        @include('frontend.parts.footer')
      </div>
    </div>
  </div>
</body>
</html>
