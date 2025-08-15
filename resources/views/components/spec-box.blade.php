<!-- resources/views/components/spec-box.blade.php -->
<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-lg p-6 shadow-sm']) }}>
    {{ $slot }}
</div>
