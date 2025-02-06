<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                <img class="mw-100" height="100" src="{{ asset('assets/img/logow.png') }}" 
                        alt="{{ get_setting('site_name') }}">
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text"
                    name="" placeholder="{{  trans('messages.search_in_menu') }}" id="menu-search"
                    onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="aiz-side-nav-link">
                            <i class="las la-home aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{  trans('messages.dashboard') }}</span>
                        </a>
                    </li>
                    <!-- @if (Auth::user()->user_type == 'admin') -->
                <!-- @endif -->

                @canany(['manage_categories'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('categories.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['categories.index','categories.edit']) }}">
                            <i class="las la-home aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{  trans('messages.categories') }}</span>
                        </a>
                    </li>
                @endcanany
               
                <!-- Product -->
                @canany(['manage_products'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{  trans('messages.products') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <!--Submenu-->
                        <ul class="aiz-side-nav-list level-2">
                            @canany(['manage_products'])
                                <li class="aiz-side-nav-item">
                                    <a class="aiz-side-nav-link" href="{{ route('products.create') }}">
                                        <span class="aiz-side-nav-text">{{ trans('messages.add_new_product')}}</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('products.all') }}" class="aiz-side-nav-link {{ areActiveRoutes(['products.all','products.admin.edit']) }}">
                                        <span class="aiz-side-nav-text">{{  trans('messages.all_Products') }}</span>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @canany(['upload_files'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('uploaded-files.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['uploaded-files.create']) }}">
                            <i class="las la-folder-open aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ trans('messages.uploaded_files') }}</span>
                        </a>
                    </li>
                @endcanany

                @canany(['manage_brochures'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('brochures.all') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['brochures.all','brochure.create','brochure.edit', 'brochure-files.all', 'brochure-files.create','brochure-files.edit']) }}">
                            <i class="las la-file-pdf aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Brochures</span>
                        </a>
                    </li>
                @endcanany


                @canany(['manage_cerificates'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('certificates.all') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['certificates.all','certificate.create','certificate.edit', 'sections.all', 'sections.create','sections.edit', 'certificate-files.all', 'certificate-files.create','certificate-files.edit']) }}">
                            <i class="las la-certificate aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Certificates</span>
                        </a>
                    </li>
                @endcanany
                
                @canany(['manage_manuals'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('manuals.all') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['manuals.all','manual.create','manual.edit', 'manual-sections.all', 'manual-sections.create','manual-sections.edit', 'manual-files.all', 'manual-files.create','manual-files.edit']) }}">
                            <i class="las la-book aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Manuals</span>
                        </a>
                    </li>
                @endcanany

                @canany(['contact_enquiries'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('enquiries.contact') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['enquiries.contact']) }}">
                            <i class="las la-mail-bulk aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Contact Enquiries</span>
                        </a>
                    </li>
                @endcanany

                @canany(['newsletter_subscribers'])
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('subscribers.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['subscribers.index']) }}">
                            <i class=" las la-newspaper aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Newsletter Subscribers</span>
                        </a>
                    </li>
                @endcanany

                @canany(['website_setup'])
                    <li class="aiz-side-nav-item">
                        <a href="#"
                            class="aiz-side-nav-link {{ areActiveRoutes(['website.footer', 'website.header']) }}">
                            <i class="las la-desktop aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Website Setup</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.header', ['lang' => App::getLocale()]) }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">Header</span>
                                </a>
                            </li>
                        
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.footer', ['lang' => App::getLocale()]) }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['website.footer']) }}">
                                    <span class="aiz-side-nav-text">Footer</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('website.pages') }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['website.pages', 'custom-pages.create', 'custom-pages.edit']) }}">
                                    <span class="aiz-side-nav-text">Pages</span>
                                </a>
                            </li>
                        
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('home-slider.index') }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['home-slider.index', 'home-slider.create', 'home-slider.edit']) }}">
                                    <span class="aiz-side-nav-text">Home Page Sliders</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany
                <!-- Staffs -->
                @canany(['manage_staffs'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-users aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{  trans('messages.staffs') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('staffs.create') }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['staffs.create']) }}">
                                    <span class="aiz-side-nav-text">{{ trans('messages.add_new_staffs') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('staffs.index') }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['staffs.index', 'staffs.edit']) }}">
                                    <span class="aiz-side-nav-text">{{  trans('messages.all_staffs') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                @canany(['manage_roles'])
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user-lock aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ trans('messages.roles_permissions')}}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('roles.create') }}" class="aiz-side-nav-link {{ areActiveRoutes(['roles.create']) }}">
                                    <span class="aiz-side-nav-text">{{ trans('messages.add_new_role')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('roles.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['roles.index','roles.edit']) }}">
                                    <span class="aiz-side-nav-text">{{ trans('messages.all_roles')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany
              
               
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
