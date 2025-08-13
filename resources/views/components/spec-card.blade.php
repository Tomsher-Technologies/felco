@props(['title', 'value'])

<div class="group animate-on-scroll relative overflow-hidden rounded-sm border border-gray-200 bg-white p-5 shadow-sm transition-all duration-300 hover:border-orange-400 hover:shadow-md">
    {{-- Sliding background overlay --}}
    <div class="pointer-events-none absolute inset-0 z-10 -translate-x-full bg-orange-500/5 transition-transform duration-500 ease-in-out group-hover:translate-x-0"></div>

    {{-- Content --}}
    <div class="relative z-20">
        <div>
            <h3 class="text-xs font-medium uppercase tracking-wider text-gray-500 transition-all group-hover:text-orange-700">{{ $title }}</h3>
            <span class="block text-xl font-semibold text-gray-800 transition-all duration-500 ease-in-out group-hover:text-2xl">
                {{ $value }}
            </span>
        </div>
    </div>
</div>