<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'traveloka-button bg-gradient-to-r from-sky-600 to-blue-600 text-white shadow-lg hover:from-sky-500 hover:to-blue-500 focus:ring-4 focus:ring-sky-100 disabled:opacity-40',
]) }}>
    {{ $slot }}
</button>
