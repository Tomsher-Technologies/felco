@extends('frontend.layouts.app')
@section('content')
    <x-page-title :title="$page->getTranslation('title', $lang)" :description="$page->getTranslation('content1', $lang)" :image="asset('assets/images/page/234324.jpg')" />

    <section class="bg-white py-20">

        <x-container>
            <div class="mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-10">

                    <div>
                        <form action="{{ route('contact.submit') }}" method="post" class="space-y-6 bg-white border p-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <input type="text" name="firstName" placeholder="{{ trans('messages.first_name') }}*"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('firstName') }}">
                                    @error('firstName')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <input type="text" name="lastName" placeholder="{{ trans('messages.last_name') }}*"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('lastName') }}">
                                    @error('lastName')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <input type="email" name="email" placeholder="{{ trans('messages.email') }}*"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <input type="tel" name="phone" placeholder="{{ trans('messages.phone') }}"
                                        class="form-input w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2">
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
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <textarea name="message" rows="5"
                                    class="form-textarea w-full focus:ring-2 focus:ring-[#f06425] hover:border-[#f06425]"
                                    placeholder="{{ trans('messages.message') }}...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                @error('g-recaptcha-response')
                                    <p class="text-red-500 text-sm">This field is required</p>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit"
                                    class="relative inline-flex items-center justify-center
                                    gap-2 px-4 py-2 font-semibold text-sm transition-colors duration-300 shadow-lg group
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

                    <div class="bg-[#1e1e1e] text-white p-12 rounded-lg shadow-2xl space-y-10 border border-gray-700">

                        <div>
                            <h3 class="text-4xl font-light text-white mb-2">Get In Touch</h3>
                            <p class="text-gray-400">{{ $page->getTranslation('heading2', $lang) }}</p>
                        </div>

                        <div class="space-y-8">

                            <div class="flex items-start space-x-5">
                                <div class="flex-shrink-0 bg-[#f06425] p-4 rounded-full">
                                    <img src="{{ asset('assets/images/icons/location.svg') }}" alt="Location"
                                        class="w-6 h-6">
                                </div>
                                <div>
                                    <h4 class="text-sm text-gray-400 uppercase tracking-wider">Our Office</h4>
                                    <p class="text-lg text-gray-200 pt-1">{{ $page->getTranslation('content', $lang) }}</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-5">
                                <div class="flex-shrink-0 bg-[#f06425] p-4 rounded-full">
                                    <img src="{{ asset('assets/images/icons/phone.svg') }}" alt="Phone" class="w-6 h-6">
                                </div>
                                <div>
                                    <h4 class="text-sm text-gray-400 uppercase tracking-wider">Phone</h4>
                                    <a href="tel:{{ $page->getTranslation('heading3', $lang) }}"
                                        class="text-lg text-white pt-1 inline-block hover:text-[#f06425] transition-colors duration-300">{{ $page->getTranslation('heading3', $lang) }}</a>
                                </div>
                            </div>

                            <div class="flex items-start space-x-5">
                                <div class="flex-shrink-0 bg-[#f06425] p-4 rounded-full">
                                    <img src="{{ asset('assets/images/icons/mail.svg') }}" alt="Mail" class="w-6 h-6">
                                </div>
                                <div>
                                    <h4 class="text-sm text-gray-400 uppercase tracking-wider">Email</h4>
                                    <a href="mailto:{{ $page->getTranslation('heading4', $lang) }}"
                                        class="text-lg text-white pt-1 inline-block hover:text-[#f06425] transition-colors duration-300">{{ $page->getTranslation('heading4', $lang) }}</a>
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
