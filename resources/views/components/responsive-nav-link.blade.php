@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-3 rounded-2xl bg-sky-100 text-sky-700 font-semibold'
            : 'block px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
