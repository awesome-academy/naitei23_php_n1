<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'traveloka-button bg-red-500 text-white shadow hover:bg-red-400 focus:ring-4 focus:ring-red-100',
]) }}>
    {{ $slot }}
</button>
