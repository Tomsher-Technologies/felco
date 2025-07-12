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


                <li class="{{ areWebActiveRoutes(['products','products.category']) }}">
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
                                                <a href="{{ route('products.category', ['category_slug' => $header_categories->slug]) }}">
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

                <li class="{{ areWebActiveRoutes(['industries','marine','oil_gas','hvac']) }}">
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

                <li class="{{ areWebActiveRoutes(['brochures','certificates','manuals','service_sales']) }}">
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
                                                    <h3>{{ trans('messages.brochures') }}</h3>
                                                    <p>
                                                        {{ get_setting('brochure_content', null, $lang) }}
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
                                                    <h3>{{ trans('messages.certificates') }}</h3>
                                                    <p>{{ get_setting('certificate_content', null, $lang) }}</p>
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
                                                    <h3>{{ trans('messages.manuals') }}</h3>
                                                    <p>{{ get_setting('manuals_content', null, $lang) }}</p>
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
                                                    <h3>{{ trans('messages.service_after_sales') }}</h3>
                                                    <p>{{ get_setting('service_sales_content', null, $lang) }}</p>
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

                <li class="{{ areWebActiveRoutes(['about_us']) }}">
                    <a href="{{ route('about_us') }}">{{ trans('messages.about_us') }}</a>
                </li>

                <li class="{{ areWebActiveRoutes(['contact']) }}">
                    <a href="{{ route('contact') }}">{{ trans('messages.contact_us') }}</a>
                </li>
            </ul>
        </div>

        <div class="search-contact fl-right-menu order-2 order-md-3">
            <div class="language-dropdown fl-language">
                <select id="lang-change">
                    <option value="en" @if ($lang == 'en') selected @endif>EN</option>
                    <option value="nl" @if ($lang == 'nl') selected @endif>NL</option>
                </select>
            </div>
            <div class="contact-btn d-none d-md-block">
                <a href="{{ route('contact') }}"
                    class="theme-btn fl-get-in-touch-icon">{{ trans('messages.get_in_touch') }}</a>
            </div>
        </div>
    </nav>
</header>
