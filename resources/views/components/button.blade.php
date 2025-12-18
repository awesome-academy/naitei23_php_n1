{{-- Ghi chú (Tiếng Việt):
    - Component `button` mặc định dùng cho form submit và các nút chính.
    - Nếu cần biến thể (danger/secondary), sử dụng component tương ứng để giữ style nhất quán.
--}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'traveloka-button bg-sky-600 text-white shadow-lg hover:bg-sky-500 focus:ring-4 focus:ring-sky-100 disabled:opacity-50']) }}>
    {{ $slot }}
</button>