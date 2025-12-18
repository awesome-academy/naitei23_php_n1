@props(['disabled' => false])

{{-- Ghi chú (Tiếng Việt):
    - `text-input` là component input cơ bản dùng cho các form.
    - Thuộc tính `disabled` hỗ trợ vô hiệu hóa input khi cần.
--}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'traveloka-input w-full py-3 px-4 bg-white rounded-2xl shadow-sm',
]) !!}>

