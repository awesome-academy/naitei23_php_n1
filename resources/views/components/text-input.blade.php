@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'traveloka-input w-full py-3 px-4 bg-white rounded-2xl shadow-sm',
]) !!}>

