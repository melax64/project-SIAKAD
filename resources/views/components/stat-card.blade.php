@props([
    'title',
    'value',
    'icon',
    'color' => 'blue',
    'trend' => null
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'orange' => 'bg-orange-100 text-orange-600',
    ];
@endphp

<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-600">{{ $title }}</p>
        <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $colorClasses[$color] }}">
            <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        </div>
    </div>
    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $value }}</h2>
    @if($trend)
        <p class="text-sm text-gray-500">{{ $trend }}</p>
    @endif
</div>
