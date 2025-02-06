<header>
    @php
        $lang = getActiveLanguage();
        $details = getCategoryHeader();

    @endphp
    <nav class="navbar">
        <div class="brand-and-icon">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('assets/images/logo/logo-black-and-color.png') }}" alt="">
            </a>
            <button type="button" class="navbar-toggler">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <div class="navbar-collapse order-3 order-md-2">
            <ul class="navbar-nav">


                <li>
                    <a href="{{ route('products') }}" class="menu-link">
                        {{ trans('messages.products') }}
                        <span class="drop-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="sub-menu">
                        <!-- item -->

                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ uploaded_asset(get_setting('header_category_logo')) }}"
                                    class="h-100 object-fit-cover" alt="">
                            </div>
                            <div class="col-md-9">
                                <div class="fl-grid-container">

                                    @if (!empty($details['header_categories']))
                                        @foreach ($details['header_categories'] as $header_categories)
                                            <div class="fl-grid-item">
                                                <a
                                                    href="{{ route('products.category', ['category_slug' => $header_categories->slug]) }}">
                                                    <div class="fl-category-title">

                                                        <span class="fl-divider"></span>
                                                        <div class="">
                                                            <h3>{{ $header_categories->getTranslation('name', $lang) }}
                                                            </h3>
                                                            <p>{{ $header_categories->getTranslation('home_content', $lang) }}
                                                            </p>
                                                        </div>
                                                        <i class="bi bi-arrow-right"></i>

                                                    </div>
                                                </a>

                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <a href="{{ route('industries') }}" class="menu-link">
                        {{ trans('messages.industries') }}
                        <span class="drop-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="sub-menu">

                        <div class="row">
                            <div class="col-md-4 image-overlay-container">
                                <a href="{{ route('marine') }}" class="">
                                    <div class="image-container">
                                        <img src="{{ getPageImage('marine') }}" alt="">
                                        <span class="image-text">{{ trans('messages.marine') }}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('oil_gas') }}" class="image-overlay-container">
                                    <div class="image-container">
                                        <img src="{{ getPageImage('oil_gas') }}" alt="">
                                        <span class="image-text">{{ trans('messages.oil_gas') }}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('hvac') }}" class="image-overlay-container">
                                    <div class="image-container">
                                        <img src="{{ getPageImage('hvac') }}" alt="">
                                        <span class="image-text">{{ trans('messages.hvac') }}</span>
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                </li>

                {{-- <li>
                    <a href="{{ route('service_support') }}"></a>
                </li> --}}

                <li>
                    <a href="#" class="menu-link">
                        {{ trans('messages.service_support') }}
                        <span class="drop-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="sub-menu">
                        <!-- item -->
                        <div class="row">

                            <div class="col-md-12">
                                <div class="fl-grid-container">
                                    <div class="fl-grid-item">
                                        <a href="{{ route('brochures') }}">
                                            <div class="fl-category-title">
                                                <span class="fl-divider"></span>
                                                <div class="">
                                                    <h3>Brochures</h3>
                                                    <p>
                                                        Browse our brochures or download catalogs for more information.
                                                    </p>
                                                </div>
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="fl-grid-item">
                                        <a href="{{ route('certificates') }}">
                                            <div class="fl-category-title">
                                                <span class="fl-divider"></span>
                                                <div class="">
                                                    <h3>Certificates</h3>
                                                    <p>Explore our marine, industrial, and material certificates below.
                                                    </p>
                                                </div>
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="fl-grid-item">
                                        <a href="{{ route('manuals') }}">
                                            <div class="fl-category-title">
                                                <span class="fl-divider"></span>
                                                <div class="">
                                                    <h3>Manuals</h3>
                                                    <p>Find manuals for our motors here. Contact us anytime for
                                                        assistance</p>
                                                </div>
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="fl-grid-item">
                                        <a href="{{ route('service_sales')  }}">
                                            <div class="fl-category-title">
                                                <span class="fl-divider"></span>
                                                <div class="">
                                                    <h3>Service/After Sales</h3>
                                                    <p>We maintain close cooperation with our global distributors. </p>
                                                </div>
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <a href="{{ route('about_us') }}">{{ trans('messages.about_us') }}</a>
                </li>

                <li>
                    <a href="{{ route('contact') }}">{{ trans('messages.contact_us') }}</a>
                </li>
            </ul>
        </div>

        <div class="search-contact fl-right-menu order-2 order-md-3">
            <div class="language-dropdown fl-language">
                <select id="lang-change">
                    <option value="en" @if (getActiveLanguage() == 'en') selected @endif>EN</option>
                    <option value="nl" @if (getActiveLanguage() == 'nl') selected @endif>NL</option>
                </select>
            </div>
            <div class="contact-btn d-none d-md-block">
                <a href="{{ route('contact') }}"
                    class="theme-btn fl-get-in-touch-icon">{{ trans('messages.get_in_touch') }}</a>
            </div>
        </div>
    </nav>
</header>
