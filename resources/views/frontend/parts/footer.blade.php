<footer class="bg-[#2a2a2a] text-[#ededed] py-12">
    <x-container>
        {{-- CTA/Newsletter Section --}}
        <div class="flex flex-col lg:flex-row justify-between items-start gap-10 mb-12 border-b border-[#333] pb-12">
            {{-- CTA/Contact --}}
            <div class="flex-1 min-w-[220px] space-y-4">
                <h2 class="text-2xl font-light text-white">Ready to move forward?</h2>
                <p class="text-sm text-[#bbbbbb]">
                    Let’s discuss how Felco Motors can power your business.  
                    <span class="block mt-1">From industrial motors to tailored solutions — talk to our experts.</span>
                </p>
                <a href="{{ route('contact') }}"
                   class="inline-block bg-[#f06425] hover:bg-[#e14e0f] text-white px-6 py-2 transition-colors duration-200 font-medium">
                    Get in Touch
                </a>
            </div>
            {{-- Newsletter --}}
            <div class="flex-1 min-w-[220px] space-y-4">
                <h3 class="text-xl font-light text-white">Stay Updated</h3>
                <p class="text-sm text-[#bbbbbb]">Join our newsletter for product news and exclusive offers.</p>
                <form id="newsletterForm" class="flex flex-col sm:flex-row items-center gap-2">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Your email address"
                        class="w-full sm:w-auto flex-1 px-4 py-2 bg-[#232323] border border-[#3d3d3d] placeholder-[#8b8b8b] text-[#ededed] outline-none focus:border-[#f06425] focus:ring-1 focus:ring-[#f06425]  transition"
                        required
                    />
                    <button type="submit"
                            class="bg-[#f06425] hover:bg-[#e14e0f] text-white px-4 py-2 transition-colors duration-200 font-medium ">
                        Subscribe
                    </button>
                </form>
                <div id="newsletterMessage" class="text-sm mt-2"></div>
            </div>
        </div>

        {{-- Fun Decorative Divider --}}
        <div class="flex items-center justify-center my-8">
            <span class="block w-10 h-0.5 bg-[#444]"></span>
            <svg class="mx-3 w-8 h-8 text-[#f06425]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4M12 3v18"/>
            </svg>
            <span class="block w-10 h-0.5 bg-[#444]"></span>
        </div>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            {{-- Logo & About --}}
            <div>
                <img src="/assets/images/logo/logo-text.svg" alt="Felco Motors Logo" class="mb-4 max-w-[190px]" />
                <p class="text-sm text-[#bbbbbb] mb-3">
                    Felco Motors provides high-performance electric motors, controls, and complete drive systems for heavy industry and OEMs in the Middle East.
                    <span class="block mt-2">Reliability. Innovation. Trusted for over 20 years.</span>
                </p>
                <div class="flex items-center space-x-2 mt-6">
                    <svg class="w-4 h-4 text-[#f06425]" fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="10" />
                    </svg>
                    <span class="text-xs tracking-wide text-[#bbbbbb]">ISO 9001:2015 Certified</span>
                </div>
            </div>
            {{-- Company Links --}}
            <div>
                <h4 class="text-lg font-light text-white mb-3">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('products') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">Products</a></li>
                    <li><a href="{{ route('industries') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">Industries</a></li>
                    <li><a href="{{ route('about_us') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">Contact</a></li>
                </ul>
            </div>
            {{-- Useful Links --}}
            <div>
                <h4 class="text-lg font-light text-white mb-3">Useful Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('faq') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">FAQ</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">Terms &amp; Conditions</a></li>
                    <li><a href="{{ route('products.category', ['category_slug' => 'explore']) }}" class="text-[#bbbbbb] hover:text-[#f06425] transition">Explore Products</a></li>
                </ul>
            </div>
            {{-- Contact Info --}}
            <div>
                <h4 class="text-lg font-light text-white mb-3">Contact</h4>
                <ul class="space-y-2 text-sm">
                    <li>Industrial Area, Warehouse 17, Dubai, UAE</li>
                    <li>
                        Phone:
                        <a href="tel:+97148123456" class="hover:text-[#f06425] transition">+971 4 812 3456</a>
                    </li>
                    <li>
                        Email:
                        <a href="mailto:info@felcomotors.com" class="hover:text-[#f06425] transition">info@felcomotors.com</a>
                    </li>
                </ul>
              <div class="flex gap-4 mt-4">
                    {{-- Facebook --}}
                    <a href="https://facebook.com" aria-label="Facebook" target="_blank" rel="noopener" class="hover:text-orange-400 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.676 0H1.326c-.732 0-1.326.593-1.326 1.326v21.348c0 .732.594 1.326 1.326 1.326h11.494V14.706h-3.128v-3.623h3.128v-2.671c0-3.1 1.89-4.788 4.658-4.788 1.325 0 2.463.099 2.797.144v3.24h-1.919c-1.504 0-1.797.714-1.797 1.763v2.312h3.587l-.467 3.675H17.82V24h4.856c.732 0 1.324-.594 1.324-1.326V1.326C24 .593 23.408 0 22.676 0"/>
                        </svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="https://instagram.com" aria-label="Instagram" target="_blank" rel="noopener" class="hover:text-orange-400 transition">
                    

                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 512.00096 512.00096" xmlns="http://www.w3.org/2000/svg" id="fi_1077042"><path d="m373.40625 0h-234.8125c-76.421875 0-138.59375 62.171875-138.59375 138.59375v234.816406c0 76.417969 62.171875 138.589844 138.59375 138.589844h234.816406c76.417969 0 138.589844-62.171875 138.589844-138.589844v-234.816406c0-76.421875-62.171875-138.59375-138.59375-138.59375zm108.578125 373.410156c0 59.867188-48.707031 108.574219-108.578125 108.574219h-234.8125c-59.871094 0-108.578125-48.707031-108.578125-108.574219v-234.816406c0-59.871094 48.707031-108.578125 108.578125-108.578125h234.816406c59.867188 0 108.574219 48.707031 108.574219 108.578125zm0 0"></path><path d="m256 116.003906c-77.195312 0-139.996094 62.800782-139.996094 139.996094s62.800782 139.996094 139.996094 139.996094 139.996094-62.800782 139.996094-139.996094-62.800782-139.996094-139.996094-139.996094zm0 249.976563c-60.640625 0-109.980469-49.335938-109.980469-109.980469 0-60.640625 49.339844-109.980469 109.980469-109.980469 60.644531 0 109.980469 49.339844 109.980469 109.980469 0 60.644531-49.335938 109.980469-109.980469 109.980469zm0 0"></path><path d="m399.34375 66.285156c-22.8125 0-41.367188 18.558594-41.367188 41.367188 0 22.8125 18.554688 41.371094 41.367188 41.371094s41.371094-18.558594 41.371094-41.371094-18.558594-41.367188-41.371094-41.367188zm0 52.71875c-6.257812 0-11.351562-5.09375-11.351562-11.351562 0-6.261719 5.09375-11.351563 11.351562-11.351563 6.261719 0 11.355469 5.089844 11.355469 11.351563 0 6.257812-5.09375 11.351562-11.355469 11.351562zm0 0"></path></svg>
                    </a>
                    {{-- LinkedIn --}}
                    <a href="https://linkedin.com" aria-label="LinkedIn" target="_blank" rel="noopener" class="hover:text-orange-400 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452H17.21V15.81c0-1.105-.021-2.529-1.541-2.529-1.542 0-1.776 1.205-1.776 2.451v4.72H10.072V9.5h3.1v1.496h.045c.432-.817 1.49-1.676 3.063-1.676 3.277 0 3.88 2.157 3.88 4.964v6.168h-.002zM5.337 7.433a1.74 1.74 0 1 1 0-3.48 1.74 1.74 0 0 1 0 3.48zm1.673 13.019H3.664V9.5h3.346v10.952zM22.225 0H1.771C.792 0 0 .771 0 1.729v20.542C0 23.229.792 24 1.771 24h20.451c.979 0 1.771-.771 1.771-1.729V1.729C24 .771 23.208 0 22.225 0z"/>
                        </svg>
                    </a>
                </div>
                <div class="flex items-center mt-4 text-xs text-[#8b8b8b] gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10" /></svg>
                    24/7 Emergency Support Available
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="border-t border-[#333] pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-[#bbbbbb]">
            <div>
                &copy; {{ date('Y') }} Felco Motors. Dubai, UAE. All rights reserved.
            </div>
            <div class="flex gap-3 mt-2 sm:mt-0">
                <a href="{{ route('terms') }}" class="hover:text-[#f06425] transition">Terms &amp; Conditions</a>
                <span>&middot;</span>
                <a href="{{ route('privacy') }}" class="hover:text-[#f06425] transition">Privacy Policy</a>
                <span>&middot;</span>
                <a href="https://www.tomsher.com/" target="_blank" rel="noopener" class="hover:text-[#f06425] no-underline transition">Website by Tomsher</a>
            </div>
        </div>
    </x-container>
</footer>
