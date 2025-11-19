<button {{ $attributes->merge(['type' => 'submit', 'class' => 'traveloka-button bg-sky-600 text-white shadow-lg hover:bg-sky-500 focus:ring-4 focus:ring-sky-100 disabled:opacity-50']) }}>
    {{ $slot }}
</button>