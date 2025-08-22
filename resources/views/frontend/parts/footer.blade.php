<footer class="bg-[#707777]  text-[#ededed]">
    <div class="pt-[50px] pb-[30px] h-full">
        <x-container>

            {{-- 1. Top Section with Logo and Navigation --}}

            {{-- 1. Centered Logo & Main Navigation --}}
            <div class="mb-12 flex flex-col items-center text-center">
                <a href="{{ route('home') }}" aria-label="Home">
                    <img src="{{ asset('assets/images/logo/logo-text.svg') }}" alt="Felco Motors Logo"
                        class="mb-8 h-auto w-full max-w-[220px]" />
                </a>
                <nav aria-label="Footer navigation">
                    <ul class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-base font-medium text-[#cccccc]">
                        <li><a href="{{ route('about_us') }}" class="transition text-white hover:text-white">About
                                Us</a></li>
                        <li><a href="{{ route('products') }}"
                                class="transition text-white hover:text-white">Products</a></li>
                        <li><a href="{{ route('industries_web') }}"
                                class="transition text-white hover:text-white">Industries</a></li>
                        <li><a href="{{ route('contact') }}" class="transition  text-white hover:text-white">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            {{-- 2. Action Section (Newsletter & Socials) --}}
            <div
                class="grid grid-cols-1 items-center gap-10 border-y border-[#505757] py-12 text-center lg:grid-cols-2 lg:text-left">
                {{-- Newsletter --}}
                <div>
                    <h4 class="text-xl font-light text-white">Stay Updated</h4>
                    <p class="mt-1 text-sm text-[#cccccc]">Join our newsletter for the latest product news.</p>
                    <form id="newsletterForm" class="mt-4 flex items-center">
                        <input type="email" name="email" placeholder="Your email address" required
                            class="w-full flex-grow border-0 bg-[#5a6161] px-4 py-2.5 text-[#ededed] placeholder-[#b0b7b7] transition focus:outline-none focus:ring-2 focus:ring-[#f06425]" />
                        <button type="submit"
                            class="shrink-0 bg-[#f06425] p-3 font-medium text-white transition-colors duration-200 hover:bg-[#e14e0f]">
                            <i class="fi fi-rr-paper-plane text-base"></i>
                        </button>
                    </form>
                    <div id="newsletterMessage" class="mt-2 text-sm"></div>
                </div>

                {{-- Socials --}}
                <div class="lg:text-right">
                    <h4 class="text-xl font-light text-white">Follow Us</h4>
                    <p class="mt-1 mb-4 text-sm text-[#cccccc]">Connect with us on social media.</p>
                    <div class="flex items-center justify-center gap-5 text-[#ededed] lg:justify-end">
                        <a href="https://facebook.com" aria-label="Facebook" target="_blank" rel="noopener"
                            class="transition text-white hover:text-[#ddd]">
                            <x-icons.facebook class="h-6 w-6" />
                        </a>
                        <a href="https://instagram.com" aria-label="Instagram" target="_blank" rel="noopener"
                            class="transition text-white hover:text-[#ddd]">
                            <x-icons.instagram class="h-6 w-6" />
                        </a>
                        <a href="https://linkedin.com" aria-label="LinkedIn" target="_blank" rel="noopener"
                            class="transition text-white hover:text-[#ddd]">
                            <x-icons.linkedin class="h-6 w-6" />
                        </a>
                    </div>
                </div>
            </div>


            {{-- 3. Footer Bottom --}}
            <div
                class="flex flex-col items-center gap-4 pt-8  text-center text-xs text-[#cccccc] sm:flex-row sm:justify-between">
                <p>&copy; {{ now()->year }} Felco Motors. All rights reserved.</p>
                <div class="sm:text-right w-full sm:w-auto text-[#707777] absolute left-[-9999px] top-[-9999px]">
                    Designed by
                    <a href="https://www.tomsher.com" target="_blank" rel="noopener"
                        class="text-[#707777]  no-underline">tomsher</a>
                </div>
            </div>



        </x-container>


    </div>



</footer>
