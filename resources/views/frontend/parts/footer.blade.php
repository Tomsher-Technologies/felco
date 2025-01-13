    <footer class="fl-footer">
        @php
            $pageData = getPageData('home');
            $lang = getActiveLanguage();
        @endphp
        <div class="container">
            <div class="fl-footer-top">
                <div class="fl-cta-section">
                    <h2>{{ get_setting('footer_title', null, $lang) }}</h2>
                    <a href="{{ route('contact') }}" class="theme-btn fl-get-in-touch-icon">{{ trans('messages.get_in_touch') }}</a>
                </div>
                <div class="fl-newsletter-section">
                    <h3>{{ get_setting('newsletter_title', null, $lang) }}</h3>
                    <p>{{ get_setting('newsletter_sub_title', null, $lang) }}</p>
                    {{-- <form class="fl-newsletter-form" aria-label="Newsletter Subscription">
                        <input type="email" placeholder="{{ trans('messages.email') }}" required aria-label="Email Address" />
                        <button type="submit">{{ trans('messages.subscribe') }}</button>
                    </form> --}}
                    <form class="fl-newsletter-form"  id="newsletterForm">
                        <input type="email" placeholder="{{trans('messages.email')}}"  name="email" class="blog-newsletter__input" />
                        <button type="submit" class="blog-newsletter__submit">{{ trans('messages.subscribe') }}</button>
                    </form>
                    <div id="newsletterMessage"></div>
                </div>
            </div>

     

            <div class="fl-footer-content">
            
                <div class="fl-footer-description">
                    <div class="fl-logo mt-0 mb-3">
                        <img src="{{ asset('assets/images/logo/logo-white.png') }}" alt="Felco Motors Logo" />
                    </div>

                    <p> {!! get_setting('footer_description', null, $lang) !!}</p>
                    
                  </div>

                <div class="fl-footer-links">
                    <h4>{{ trans('messages.company') }}</h4>
                    <ul>
                        <li><a href="{{ route('products') }}">{{ trans('messages.products') }}</a></li>
                        <li><a href="{{ route('industries') }}">{{ trans('messages.industries') }}</a></li>
                        <li><a href="{{ route('about_us') }}">{{ trans('messages.about_us') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ trans('messages.contact_us') }}</a></li>
                    </ul>
                </div>

                <div class="fl-footer-links">
                    <h4>{{ trans('messages.useful_links') }}</h4>
                    <ul>
                        <li><a href="{{ route('faq') }}">{{ trans('messages.faq') }}</a></li>
                        <li><a href="{{ route('privacy') }}">{{ trans('messages.privacy_policy') }}</a></li>
                        <li><a href="{{ route('terms') }}">{{ trans('messages.terms_conditions') }}</a></li>
                    </ul>
                </div>

                <div class="fl-footer-links">
                    <h4>{{ trans('messages.contact_us') }}</h4>
                    <ul>
                        <li>{{ get_setting('footer_address') }}</li>
                        <li>{{ trans('messages.phone') }}: {{ get_setting('footer_phone') }}</li>
                        <li>{{ trans('messages.email') }}: <a href="mailto:{{ get_setting('footer_email') }}">{{ get_setting('footer_email') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="fl-footer-bottom">
                <p> {!! get_setting('frontend_copyright_text', null, $lang) !!} | {{ trans('messages.designed_by') }} <a href="https://www.tomsher.com/" target="_blank">{{ trans('messages.tomsher') }}</a></p>
                <div class="social_link m-0 p-0">
                    <ul>
                        <li>
                            <a href="{{ get_setting('facebook_link') }}" target="_blank"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li>
                            <a href="{{ get_setting('instagram_link') }}" target="_blank"><i class="bi bi-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>