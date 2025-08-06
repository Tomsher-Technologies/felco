@extends('frontend.layouts.app')
@section('content')
    <!-- Page Title Section with Left Dark Content and Right Parallax Image -->
    <x-page-title
        :title="$page->getTranslation('title', $lang)"
        :description="$page->getTranslation('content1', $lang)"
        :image="asset('assets/images/page/contact.jpg')"
    />

    <!-- Contact Form Section -->
    <section class="bg-white py-20">

       <x-container>
        <div class="mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-10">

                <!-- Form -->
                <div>
                    <form action="{{ route('contact.submit') }}" method="post" class="space-y-6 bg-white border p-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="text" name="firstName" placeholder="{{ trans('messages.first_name') }}*" class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]" value="{{ old('firstName') }}">
                                @error('firstName')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <input type="text" name="lastName" placeholder="{{ trans('messages.last_name') }}*" class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]" value="{{ old('lastName') }}">
                                @error('lastName')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="{{ trans('messages.email') }}*" class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]" value="{{ old('email') }}">
                                @error('email')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <select name="subject" class="form-select w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]">
                                    <option value="">{{ trans('messages.select_subject') }}</option>
                                    <option value="general_enquiry" @selected(old('subject') == 'general_enquiry')>{{ trans('messages.general_enquiry') }}</option>
                                    <option value="support" @selected(old('subject') == 'support')>{{ trans('messages.support') }}</option>
                                    <option value="feedback" @selected(old('subject') == 'feedback')>{{ trans('messages.feedback') }}</option>
                                    <option value="custom_request" @selected(old('subject') == 'custom_request')>{{ trans('messages.custom_request') }}</option>
                                </select>
                                @error('subject')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <textarea name="message" rows="5" class="form-textarea w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]" placeholder="{{ trans('messages.message') }}...">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                            @error('g-recaptcha-response')<p class="text-red-500 text-sm">This field is required</p>@enderror
                        </div>

                        <div class="text-right">
                            <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-[#f06425] transition">
                                {{ trans('messages.submit') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="bg-[#2a2a2a] text-white p-8 shadow space-y-6">
                    <div>
                        <h5 class="text-3xl  text-white font-thin mb-7">{{ $page->getTranslation('heading2', $lang) }}</h5>
                        <ul class="space-y-3">
                            <li><img src="{{ asset('assets/images/icons/location.svg') }}" alt="Location" class="inline-block w-5 h-5 mr-2">{{ $page->getTranslation('content', $lang) }}</li>
                            <li><img src="{{ asset('assets/images/icons/phone.svg') }}" alt="Phone" class="inline-block w-5 h-5 mr-2"><a href="tel:{{ $page->getTranslation('heading3', $lang) }}">{{ $page->getTranslation('heading3', $lang) }}</a></li>
                            <li><img src="{{ asset('assets/images/icons/mail.svg') }}" alt="Mail" class="inline-block w-5 h-5 mr-2"><a href="mailto:{{ $page->getTranslation('heading4', $lang) }}">{{ $page->getTranslation('heading4', $lang) }}</a></li>
                        </ul>
                    </div>

                    <div class="flex space-x-4 text-xl">
                        <a href="{{ get_setting('facebook_link') }}" target="_blank"><img src="{{ asset('assets/images/icons/facebook.svg') }}" alt="Facebook" class="w-6 h-6 hover:opacity-80"></a>
                        <a href="{{ get_setting('instagram_link') }}" target="_blank"><img src="{{ asset('assets/images/icons/instagram.svg') }}" alt="Instagram" class="w-6 h-6 hover:opacity-80"></a>
                        <a href="{{ get_setting('linkedin_link') }}" target="_blank"><img src="{{ asset('assets/images/icons/linkedin.svg') }}" alt="LinkedIn" class="w-6 h-6 hover:opacity-80"></a>
                    </div>
                </div>
            </div>
        </div>

        </x-container>
    </section>

    <!-- Google Map Section -->
    <section class="relative h-96">
        <div class="absolute inset-0 grayscale filter" id="map"></div>
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
        const latitude = {{ $page->image3 }};
        const longitude = {{ $page->image4 }};
        const mapOptions = {
            center: { lat: latitude, lng: longitude },
            zoom: 13,
            styles: [
                {
                    featureType: "all",
                    elementType: "geometry",
                    stylers: [{ color: "#202c3e" }]
                },
                {
                    featureType: "all",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#ffffff" }]
                },
                {
                    featureType: "all",
                    elementType: "labels.text.stroke",
                    stylers: [{ color: "#000000" }, { weight: 2 }]
                },
                {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{ color: "#304a7d" }]
                }
            ]
        };

        const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        const marker = new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map: map,
        });
    }
    window.onload = initMap;
</script>
@endsection
