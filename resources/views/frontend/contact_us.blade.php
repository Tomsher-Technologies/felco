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

        <div class="contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d462560.6827981485!2d54.897841244323324!3d25.07628045419027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai!5e0!3m2!1sen!2sae!4v1733469271071!5m2!1sen!2sae"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
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

@endsection
