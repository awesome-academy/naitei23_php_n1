@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 rounded-2xl bg-white text-sky-700 font-semibold shadow'
            : 'inline-flex items-center px-3 py-2 rounded-2xl text-white/80 hover:bg-white/10 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
