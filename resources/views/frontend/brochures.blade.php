@extends('frontend.layouts.app')

@push('styles')
<style>
    .subtle-pattern-bg {
        background-color: #fdfbff;
        background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23fdece5' fill-opacity='0.4'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10-10-4.477-10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10-10-4.477-10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    @keyframes tilt {
        0%, 100% { transform: rotate(-1deg); }
        50% { transform: rotate(1deg); }
    }
    .animate-tilt {
        animation: tilt 6s infinite ease-in-out;
    }
</style>
@endpush

@section('content')



@include('components.page-title', [
    'title' => $page->getTranslation('title', $lang),
    'description' => $page->getTranslation('content', $lang),
    'image' => asset('assets/images/page/catalogues.jpg')
])



<!-- Brochure Sections -->
@if (!empty($brochures[0]))
    <section class="elegant-bg py-16 md:py-20">
     
       <x-container>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                @foreach ($brochures as $key => $broch)
                    <div class="bg-white shadow-md hover:shadow-2xl border border-transparent hover:border-[#f16c31] transition-all duration-300 transform hover:-translate-y-2 flex flex-col">
                        
                        <!-- Image -->
                        <div class="overflow-hidden h-[300px]">
                            <img src="{{ uploaded_asset($broch->image) }}"
                                 class="w-full h-[300px] object-cover hover:scale-105 transition-transform duration-300"
                                 alt="{{ $broch->getTranslation('title', $lang) }}">
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-2xl font-light text-slate-800 mb-2">
                                {{ $broch->getTranslation('title', $lang) }}
                            </h3>
                            @if($broch->getTranslation('description', $lang))
                                <p class="text-slate-600 text-sm mb-4 flex-grow whitespace-pre-line">
                                    {{ $broch->getTranslation('description', $lang)}}
                                </p>
                            @endif

                            @if (!empty($broch->files[0]))
                                <div class="space-y-3 mt-auto pt-4 border-t border-slate-100">
                                    @foreach ($broch->files as $file)
                                        <!-- Hover on this individual group -->
                                        <div class="group relative bg-slate-50 hover:bg-teal-50 p-3 rounded-md transition-colors duration-300">
                                            <a href="{{ asset($file->file) }}" target="_blank"
                                               class="flex items-center justify-between text-sm font-medium text-slate-700">
                                                <span class="whitespace-pre-line text-lg font-normal">{{ $file->getTranslation('title', $lang) }}</span>
                                                <svg class="w-5 h-5 text-[#f16c31] transition-opacity duration-300 group-hover:opacity-100 opacity-0"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </a>

                                            <!-- Description shown only on hover of this item -->
                                            <p class="text-xs text-slate-500 mt-2 opacity-0 max-h-0 group-hover:opacity-100 group-hover:max-h-40 transition-all duration-300 ease-in-out overflow-hidden whitespace-pre-line">
                                                {{ $file->getTranslation('content', $lang) }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
  
</x-container>
    </section>
@endif



@endsection
