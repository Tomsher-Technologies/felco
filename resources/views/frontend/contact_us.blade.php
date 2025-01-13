@extends('frontend.layouts.app')
@section('content')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <h2>{{ $page->getTranslation('title', $lang) }}</h2>
                    <p>{{ $page->getTranslation('content1', $lang) }}</p>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->


    <!-- start contact-pg-section -->
    <section class="contact-pg-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-md-7">
                    <form action="{{ route('contact.submit') }}" method="post" class="zk-contact-form__form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-6">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="{{ trans('messages.first_name') }}*">
                                @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="{{ trans('messages.last_name') }}*">
                                @error('lastName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{ trans('messages.email') }}*">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            <div class="col-6">
                                <select class="form-select" id="subject" name="subject" aria-label="Default select example">
                                    <option value="">{{ trans('messages.select_subject') }}</option>
                                    <option value="general_enquiry">{{ trans('messages.general_enquiry') }}</option>
                                    <option value="support">{{ trans('messages.support') }}</option>
                                    <option value="feedback">{{ trans('messages.feedback') }}</option>
                                    <option value="custom_request">{{ trans('messages.custom_request') }}</option>
                                </select>
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" id="message" name="message"  rows="5" placeholder="{{ trans('messages.message') }}..."></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="theme-btn fl-get-in-touch-icon float-end">{{ trans('messages.submit') }}</button>
                            </div>



                        </div>
                    </form>

                </div>

                <div class="col col-md-5">

                    <div class="office-info">

                        <div>
                            <h5>{{ $page->getTranslation('heading2', $lang) }}</h5>
                            <ul>
                                <li><i class="bi bi-geo-alt"></i>{{ $page->getTranslation('content', $lang) }}</li>
                                <li><i class="bi bi-telephone"></i> {{ $page->getTranslation('heading3', $lang) }}</li>
                                <li><i class="bi bi-envelope"></i> {{ $page->getTranslation('heading4', $lang) }}</li>
                            </ul>
                        </div>
                        <div class="social_link">
                            <ul>
                                <li>
                                    <a href="#"><i class="bi bi-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="bi bi-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="bi bi-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end contact-pg-section -->


    <!--  start contact-map -->
    <section class="contact-map-section">

        <div class="contact-map" id="map">
           
        </div>
    </section>
@endsection

@section('script')
@if (session('scrollTo'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const targetId = "{{ session('scrollTo') }}";
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });

        
    </script>
@endif
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}"></script>
<script>
    function initMap() {
        // Replace these values with the ones from your database
        const latitude = {{ $page->image3 }};
        const longitude = {{ $page->image4 }};

        // Map options
        const mapOptions = {
            center: { lat: latitude, lng: longitude },
            zoom: 13,
        };

        // Create the map
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // Add a marker
        const marker = new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map: map,
        });
    }

    // Initialize the map when the window loads
    window.onload = initMap;
</script>

@endsection
