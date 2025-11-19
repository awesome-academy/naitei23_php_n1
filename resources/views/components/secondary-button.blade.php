<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'traveloka-button bg-white text-sky-700 border border-sky-100 shadow-sm hover:bg-sky-50 focus:ring-4 focus:ring-sky-100 disabled:opacity-50',
]) }}>
    {{ $slot }}
</button>
