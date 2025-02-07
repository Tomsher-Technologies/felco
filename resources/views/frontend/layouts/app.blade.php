<!DOCTYPE html>
<html lang="{{ getActiveLanguage() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    {!! SEO::generate() !!}

    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @yield('header')
</head>
<body>


    <div class="page-wrapper">
      
        @include('frontend.parts.header')

        @yield('content')

        @include('frontend.parts.footer')
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
     "></script>
    <script src="{{ asset('assets/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script>

$(document).ready(function() {
                @if(Session::has('message'))
                    var message = "{{ Session::get('message') }}";
                    var alertType = "{{ Session::get('alert-type', 'info') }}";  // Default to 'info' if no alert type is set
                    
                    toastr.options = {
                        closeButton: true,        // Show close button
                        debug: false,             // Debugging (off by default)
                        progressBar: true,        // Show progress bar
                        preventDuplicates: true, // Prevent duplicate toasts
                        positionClass: "toast-top-right", // Toast position
                        showDuration: "300", // Duration of show animation (ms)
                        hideDuration: "1000", // Duration of hide animation (ms)
                        showEasing: "swing",      // Show easing effect
                        hideEasing: "linear",     // Hide easing effect
                        showMethod: "fadeIn",     // Show animation
                        hideMethod: "fadeOut"   
                    };

                    // Display toastr notification
                    switch(alertType) {
                        case 'success':
                            toastr.success(message, "{{trans('messages.success')}}");
                            break;
                        case 'error':
                            toastr.error(message, "{{trans('messages.error')}}");
                            break;
                        case 'info':
                            toastr.info(message,'info');
                            break;
                        case 'warning':
                            toastr.warning(message,'warning');
                            break;
                        default:
                            toastr.info(message,'info');
                    }
                @endif 
            });

        if ($('#lang-change').length > 0) {
            $('#lang-change').on('change', function(e) {
                e.preventDefault();
                var $this = $(this);
                var locale = $this.val();
                $.post('{{ route('language.change') }}', {
                    _token: '{{ csrf_token() }}',
                    locale: locale
                }, function(data) {
                    location.reload();
                });
            });
        }
        new Swiper('.swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
          
            

            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                968: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mainColumn=document.querySelector(".fl-main-column");
            const hoverColumns=document.querySelectorAll(".fl-hover-column");

            const toggleMainColumnVisibility=(isVisible) => {
                // Check if screen size is less than 1042px
                if (window.innerWidth < 1042) {
                    mainColumn.classList.remove("hidden-content");
                    const description=mainColumn.querySelector(".fl-description");
                    const cta=mainColumn.querySelector(".fl-cta");
                    description.style.opacity="1";
                    cta.style.opacity="1";
                    description.style.visibility="visible";
                    cta.style.visibility="visible";
                    return;
                }

                // Otherwise, toggle visibility as before
                mainColumn.classList.toggle("hidden-content", !isVisible);
                const description=mainColumn.querySelector(".fl-description");
                const cta=mainColumn.querySelector(".fl-cta");
                const visibility=isVisible ? "visible" : "hidden";
                const opacity=isVisible ? "1" : "0";

                description.style.opacity=opacity;
                cta.style.opacity=opacity;
                description.style.visibility=visibility;
                cta.style.visibility=visibility;
            };

            hoverColumns.forEach(column => {
                column.addEventListener("mouseenter", () => toggleMainColumnVisibility(false));
                column.addEventListener("mouseleave", () => toggleMainColumnVisibility(true));
            });

            toggleMainColumnVisibility(true);

            // Reapply visibility logic on window resize
            window.addEventListener("resize", () => toggleMainColumnVisibility(true));
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
                    $('#newsletterMessage').html('<p style="color: #72ff72;">' + response.success + '</p>');
                    $('#newsletterForm')[0].reset();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors && errors.email) {
                        $('#newsletterMessage').html('<p style="color: red;">' + errors.email[0] + '</p>');
                    }
                }
            });
        });
    </script>
 
    @yield('script')
</body>

</html>