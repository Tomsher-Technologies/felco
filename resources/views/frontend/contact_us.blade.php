@extends('frontend.layouts.app')
@section('content')
    <x-page-title :title="$page->getTranslation('title', $lang)" :description="$page->getTranslation('content1', $lang)" :image="asset('assets/images/page/contact-us-image.jpg')" />

    {{-- Adjusted section padding and grid gap for mobile --}}
    <section class="bg-white py-12 md:py-20">

        <x-container>
            <div class="mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 md:gap-x-10">

                    

                    <div>
                        @if (session('message'))
                            <div class="mb-4 flex items-center justify-between rounded-lg border px-4 py-3 ">
                                
                                <span style="@if(session('alert-type') === 'success') color: green !important; @endif">{{ session('message') }}</span>

                                <button type="button" class="ml-4 text-xl font-bold leading-none focus:outline-none" onclick="this.parentElement.remove()">
                                    &times;
                                </button>
                            </div>
                        @endif
                        {{-- Adjusted form padding for mobile --}}
                        <form action="{{ route('contact.submit') }}" method="post" class="space-y-6 bg-white border p-3 md:p-8">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                
                                <div>
                                    <input type="text" name="firstName" placeholder="{{ trans('messages.first_name') }}*"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('firstName') }}">
                                    @error('firstName')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <input type="text" name="lastName" placeholder="{{ trans('messages.last_name') }}*"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('lastName') }}">
                                    @error('lastName')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <input type="email" name="email" placeholder="{{ trans('messages.email') }}*"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <input type="tel" name="phone" placeholder="{{ trans('messages.phone') }}"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <select name="subject"
                                        class="form-select w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]">
                                        <option value="">{{ trans('messages.select_subject') }}*</option>
                                        <option value="general_enquiry" @selected(old('subject') == 'general_enquiry')>
                                            {{ trans('messages.general_enquiry') }}</option>
                                        <option value="support" @selected(old('subject') == 'support')>
                                            {{ trans('messages.support') }}</option>
                                        <option value="feedback" @selected(old('subject') == 'feedback')>
                                            {{ trans('messages.feedback') }}</option>
                                        <option value="custom_request" @selected(old('subject') == 'custom_request')>
                                            {{ trans('messages.custom_request') }}</option>
                                    </select>
                                    @error('subject')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <textarea name="message" rows="5"
                                    class="form-textarea w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                    placeholder="{{ trans('messages.message') }}...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                {{-- Added a wrapper to handle reCAPTCHA scaling on small screens --}}
                                <div class="max-w-[304px] transform scale-[0.8] sm:scale-100 origin-left">
                                    <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                </div>
                                @error('g-recaptcha-response')
                                    <p class="text-red-500 text-sm mt-1">This field is required</p>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit"
                                    class="relative inline-flex items-center justify-center
                                    gap-2 px-6 py-2.5 font-semibold text-sm transition-colors duration-300 shadow-lg group
                                    overflow-hidden bg-orange-500 text-white border-2 border-orange-500 hover:bg-white
                                    hover:text-orange-500 hover:border-orange-500">
                                    <span class="relative z-10 flex items-center gap-2">
                                        Submit
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Adjusted padding, spacing and fonts for the contact info card --}}
                    <div class="bg-[#1e1e1e] text-white p-8 md:p-10 lg:p-12 rounded-lg shadow-2xl space-y-8 border border-gray-700">

                        <div>
                            <h3 class="text-3xl font-light text-white mb-2 md:text-4xl">Get In Touch</h3>
                            <p class="text-gray-400">{{ $page->getTranslation('heading2', $lang) }}</p>
                        </div>

                        <div class="space-y-8">

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-[#f06425] p-3 sm:p-4 rounded-full">
                                    <img src="{{ asset('assets/images/icons/location.svg') }}" alt="Location"
                                        class="w-6 h-6">
                                </div>
                                <div>
                                    <h4 class="text-sm text-gray-400 uppercase tracking-wider">Our Office</h4>
                                    <p class="text-base text-gray-200 pt-1 md:text-lg">{{ $page->getTranslation('content', $lang) }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-[#f06425] p-3 sm:p-4 rounded-full">
                                    <img src="{{ asset('assets/images/icons/phone.svg') }}" alt="Phone" class="w-6 h-6">
                                </div>
                                <div>
                                    <h4 class="text-sm text-gray-400 uppercase tracking-wider">Phone</h4>
                                    <a href="tel:{{ $page->getTranslation('heading3', $lang) }}"
                                        class="text-base text-white pt-1 inline-block hover:text-[#f06425] transition-colors duration-300 md:text-lg">{{ $page->getTranslation('heading3', $lang) }}</a>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-[#f06425] p-3 sm:p-4 rounded-full">
                                    <img src="{{ asset('assets/images/icons/mail.svg') }}" alt="Mail" class="w-6 h-6">
                                </div>
                                <div>
                                    <h4 class="text-sm text-gray-400 uppercase tracking-wider">Email</h4>
                                    <a href="mailto:{{ $page->getTranslation('heading4', $lang) }}"
                                        class="text-base text-white pt-1 inline-block hover:text-[#f06425] transition-colors duration-300 md:text-lg">{{ $page->getTranslation('heading4', $lang) }}</a>
                                </div>
                            </div>

                        </div>

                        <hr class="border-t border-gray-700">

                        <div>
                            <h4 class="text-sm text-gray-400 uppercase tracking-wider mb-4">Connect With Us</h4>
                            <div class="flex space-x-6">
                                <a href="{{ get_setting('facebook_link') }}" target="_blank"
                                    class="transform hover:scale-110 transition-transform duration-300" title="Facebook">
                                    <img src="{{ asset('assets/images/icons/facebook.svg') }}" alt="Facebook"
                                        class="w-7 h-7">
                                </a>
                                <a href="{{ get_setting('instagram_link') }}" target="_blank"
                                    class="transform hover:scale-110 transition-transform duration-300" title="Instagram">
                                    <img src="{{ asset('assets/images/icons/instagram.svg') }}" alt="Instagram"
                                        class="w-7 h-7">
                                </a>
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank"
                                    class="transform hover:scale-110 transition-transform duration-300" title="LinkedIn">
                                    <img src="{{ asset('assets/images/icons/linkedin.svg') }}" alt="LinkedIn"
                                        class="w-7 h-7">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </section>
@endsection



@section('script')
    @if (session('scrollTo'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const targetId = "{{ session('scrollTo') }}";
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        </script>
    @endif
@endsection
