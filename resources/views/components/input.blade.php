@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'traveloka-input w-full py-3 px-4 rounded-2xl shadow-sm']) !!}>
