@props([
    'href' => '#',
    'id' => '',
    'text' => '',
    'extraClasses' => '',
])

<a href="{{ $href }}" id="{{ $id }}"
    {{ $attributes->merge(['class' => "relative inline-flex items-center justify-center gap-2 px-4 py-2 font-semibold text-sm transition-colors duration-300 shadow-lg group overflow-hidden bg-orange-500 text-white border-2 border-orange-500 hover:bg-white hover:text-orange-500 hover:border-orange-500 $extraClasses"]) }}>
    <span class="relative z-10 flex items-center gap-2">
        {{ $text }}
        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none"
            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </span>
</a>
