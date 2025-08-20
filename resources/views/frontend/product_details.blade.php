@extends('frontend.layouts.app')

@section('content')

@php
    if (!isset($product)) {
        /**
         * --- MOCK DATA FOR DEMONSTRATION ---
         * If the $product variable is not passed from the controller,
         * we create a mock object to populate the page for layout testing.
         * This class mimics the real Product model's structure.
         */
        class MockProduct {
            public $unique_id = 'DEMO-X100';
            public $image = 'https://via.placeholder.com/800x800.png/ff6600/ffffff?text=Sample+Product';
            public $frame_size = '180M';
            public $power = '22 kW / 30 HP';
            public $poles = '4';
            public $speed = '1480 RPM';
            public $mounting = 'IM B3 (Foot Mounted)';
            public $voltage = '400/690V';
            public $efficiency = 'IE3 Premium';
            public $files;

            private $translations = [
                'name' => 'Sample High-Performance Motor',
                'market' => 'General Industrial Use',
            ];

            public function __construct() {
                // To test the "show design if no data" feature, we can start with an empty collection.
                // The logic below will then populate it with samples.
                $this->files = collect([]);
            }

            public function getTranslation($field, $lang) {
                return $this->translations[$field] ?? "Sample " . ucfirst($field);
            }
        }
        $product = new MockProduct();
        $lang = $lang ?? 'en'; // Set a default language if not available
    }
@endphp


{{-- Main Product Section --}}
<section class="py-16 md:py-24 text-slate-800 bg-gradient-to-br from-orange-50 via-white to-white border border-slate-200">
    <x-container>

        {{-- 1. Page Header: Title, Product ID, and Back Button --}}
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-12">
            <div>
                <h1 class="text-4xl md:text-5xl font-light text-slate-900 leading-tight tracking-tight">
                    {{ $product->getTranslation('name', $lang) }}
                </h1>
                {{-- <p class="mt-2 text-lg text-orange-600 font-mono">
                    {{ trans('messages.product') . ' ' . trans('messages.id') }}: {{ $product->unique_id }}
                </p> --}}
            </div>
            <div class="flex-shrink-0">
                <a href="{{ Session::has('last_url') ? Session::get('last_url') : route('products') }}"
                   class="inline-flex items-center gap-2 bg-orange-600 text-white px-5 py-3 shadow-md hover:bg-orange-700 transition-colors duration-300">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    <span>{{ trans('messages.go_back') }}</span>
                </a>
            </div>
        </div>

        {{-- 2. Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-5 items-start">

            {{-- Left Column: Sticky Product Image --}}
            <div class="lg:col-span-2 lg:sticky lg:top-8">
                <div class="overflow-hidden shadow-2xl border border-slate-200">
                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}"
                         alt="{{ $product->getTranslation('name', $lang) }}"
                         class="w-full h-auto object-cover">
                </div>
            </div>

            {{-- Right Column: Scrolling Product Information --}}
            <div class="lg:col-span-3 space-y-8">

                {{-- Card 1: Technical Specifications --}}
                <div class="bg-gradient-to-br from-orange-50 via-white to-white border border-slate-200 shadow-lg p-8">
                    <h3 class="text-2xl font-normal text-slate-900 mb-6">Technical Specifications</h3>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.frame_size') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->frame_size }}</dd>
                        </div>
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.power') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->power }}</dd>
                        </div>
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.poles') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->poles }}</dd>
                        </div>
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.speed') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->speed }}</dd>
                        </div>
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.mounting') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->mounting }}</dd>
                        </div>
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.voltage') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->voltage }}</dd>
                        </div>
                        <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.efficiency') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->efficiency }}</dd>
                        </div>
                         <div class="py-2 border-b border-slate-200">
                            <dt class="text-sm font-medium text-slate-500">{{ trans('messages.market') }}</dt>
                            <dd class="text-xl font-semibold text-slate-700 mt-1">{{ $product->getTranslation('market', $lang) }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Card 2: Downloads & Resources (UPDATED) --}}
                @php
                    // Determine which files to show: real files or mock files if none exist.
                    $is_sample_downloads = !(isset($product->files) && $product->files->count() > 0);

                    if ($is_sample_downloads) {
                        $download_items = collect([
                            (object)['file' => '#', 'heading' => 'Sample Datasheet (PDF)'],
                            (object)['file' => '#', 'heading' => 'Sample Manual (DOCX)'],
                            (object)['file' => '#', 'heading' => 'Sample Drawings (ZIP)'],
                        ]);
                    } else {
                        $download_items = $product->files;
                    }
                @endphp

                <div class="bg-gradient-to-br from-orange-50 via-white to-white border border-slate-200 shadow-lg p-8">
                    <h3 class="text-2xl font-normal text-slate-900 mb-6">{{ trans('messages.downloads') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($download_items as $download)
                            @php
                                $file_path = $download->file;
                                $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

                                // For sample data, derive extension from heading
                                if ($is_sample_downloads) {
                                    if (str_contains(strtolower($download->heading), 'pdf')) $extension = 'pdf';
                                    if (str_contains(strtolower($download->heading), 'docx')) $extension = 'docx';
                                    if (str_contains(strtolower($download->heading), 'zip')) $extension = 'zip';
                                }

                                $file_size_info = '';
                                if ($is_sample_downloads) {
                                     $file_size_info = '1.2 MB'; // Assign sample size
                                } else if (file_exists(public_path($file_path))) {
                                    $bytes = filesize(public_path($file_path));
                                    $file_size_info = $bytes > 1024*1024 ? round($bytes / (1024*1024), 1) . ' MB' : round($bytes / 1024, 1) . ' KB';
                                }

                                // Default Icon
                                $icon_svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />';

                                if ($extension == 'pdf') {
                                    $icon_svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />';
                                } elseif (in_array($extension, ['doc', 'docx'])) {
                                    $icon_svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />';
                                } elseif (in_array($extension, ['zip', 'rar', '7z'])) {
                                    $icon_svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />';
                                }
                            @endphp
                            <a href="{{ $is_sample_downloads ? '#' : asset($download->file) }}" @if(!$is_sample_downloads) target="_blank" @endif
                               class="group flex items-center gap-4 bg-white p-4 border border-slate-200 hover:border-orange-400 hover:bg-orange-50/80 transition-all duration-300 shadow-sm hover:shadow-md">
                                <div class="flex-shrink-0 bg-orange-100 text-orange-600 p-3 rounded-lg">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        {!! $icon_svg !!}
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800 group-hover:text-orange-700 transition-colors">{{ $download->heading }}</p>
                                    <p class="text-xs text-slate-500">{{ strtoupper($extension) }}@if($file_size_info) &middot; {{ $file_size_info }}@endif</p>
                                </div>
                                <div class="text-slate-400 group-hover:text-orange-600 transition-colors">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</section>

@endsection
