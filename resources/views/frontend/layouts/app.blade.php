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
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet" />

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('header')
</head>

<body>
    <div id="smooth-wrapper">
        @include('frontend.parts.header')
        <div id="smooth-content">
            <div id="app" class="page-wrapper">
                @yield('content')
                @include('frontend.parts.footer')
            </div>
        </div>
    </div>

    @yield('script')

    <script>
      
        document.addEventListener("DOMContentLoaded", () => {
            $('.lang-link').on('click', function(e) {
                e.preventDefault();
                var locale = $(this).data('locale');
                console.log("locale",locale);
                

                $.post('{{ route('language.change') }}', {
                    _token: '{{ csrf_token() }}',
                    locale: locale
                }, function(data) {
                    location.reload(); 
                });
            });



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#newsletterForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('newsletter.subscribe') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#newsletterMessage').html('<p style="color: #72ff72;">' + response
                            .success +
                            '</p>');
                        $('#newsletterForm')[0].reset();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors && errors.email) {
                            $('#newsletterMessage').html('<p style="color: red;">' + errors
                                .email[0] +
                                '</p>');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
