@extends('frontend.layouts.app')

@section('content')

{{-- Main Product Section --}}
<section class="py-16 md:py-24  text-slate-800 bg-gradient-to-br from-orange-50 via-white to-white border border-slate-200">
         <x-container>

        {{-- 1. Page Header: Title, Product ID, and Back Button --}}
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-12">
            <div>
                <h1 class="text-4xl md:text-5xl font-light text-slate-900 leading-tight tracking-tight">
                    {{ $product->getTranslation('name', $lang) }}
                </h1>
                <p class="mt-2 text-lg text-orange-600 font-mono">
                    {{ trans('messages.product_id') }}: {{ $product->unique_id }}
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ Session::has('last_url') ? Session::get('last_url') : route('products') }}"
                   class="inline-flex items-center gap-2 bg-orange-600 text-white px-5 py-3  shadow-md hover:bg-orange-700 transition-colors duration-300">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                    <span>{{ trans('messages.go_back') }}</span>
                </a>
            </div>
        </div>

        {{-- 2. Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-5 items-start">

            {{-- Left Column: Sticky Product Image --}}
            <div class="lg:col-span-2 lg:sticky lg:top-8">
                <div class="overflow-hidden  shadow-2xl border border-slate-200">
                    <img src="{{ asset($product->image) }}"
                         alt="{{ $product->getTranslation('name', $lang) }}"
                         class="w-full h-auto object-cover">
                </div>
            </div>

            {{-- Right Column: Scrolling Product Information --}}
            <div class="lg:col-span-3 space-y-8">

                {{-- Card 1: Technical Specifications --}}
                <div class="bg-gradient-to-br from-orange-50 via-white to-white border border-slate-200  shadow-lg p-8">
                    <h3 class="text-2xl font-normal text-slate-900 mb-6 ">Technical Specifications</h3>
                    
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

                {{-- Card 2: Downloads & Resources --}}
                @if(isset($product->files) && $product->files->count() > 0)
                <div class="bg-gradient-to-br from-orange-50 via-white to-white border border-slate-200  shadow-lg p-8">
                    <h3 class="text-2xl font-normal text-slate-900 mb-6">{{ trans('messages.downloads') }}</h3>
                    <div class="space-y-4">
                        @foreach($product->files as $download)
                        <a href="{{ asset($download->file) }}" target="_blank"
                           class="group flex items-center justify-between bg-white p-4  border border-slate-200 hover:border-orange-400 hover:bg-orange-50 transition-all duration-300">
                            <div class="flex items-center gap-4">
                                <svg class="w-6 h-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                <span class="font-semibold text-slate-700 group-hover:text-orange-700">{{ $download->heading }}</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
 </x-container>
</section>

@endsection