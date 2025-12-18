{{-- Ghi chú (Tiếng Việt):
    - `danger-button` dùng cho hành động nguy hiểm như xóa dữ liệu.
    - Luôn hiển thị hộp thoại xác nhận khi dùng hành động này.
--}}
<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'traveloka-button bg-red-500 text-white shadow hover:bg-red-400 focus:ring-4 focus:ring-red-100',
]) }}>
    {{ $slot }}
</button>
