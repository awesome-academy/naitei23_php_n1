@props(['status'])

{{-- Ghi chú (Tiếng Việt):
    - Hiển thị thông báo trạng thái phiên (ví dụ: link khôi phục đã được gửi).
    - Sử dụng component này để hiển thị message nhỏ màu xanh ở các trang auth.
--}}
@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
