@props(['value'])

{{-- Ghi chú (Tiếng Việt):
    - `input-label` dùng để hiện tiêu đề/label cho trường form.
    - Giữ style chung để nhất quán giao diện form.
--}}
<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-slate-600']) }}>
    {{ $value ?? $slot }}
</label>

