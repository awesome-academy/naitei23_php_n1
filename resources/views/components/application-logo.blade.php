{{-- Ghi chú (Tiếng Việt):
    - Component logo dùng lại trên nhiều layout.
    - Giữ kiểu đơn giản để có thể dùng ở header và các vùng auth.
--}}
<div {{ $attributes->merge(['class' => 'flex items-center gap-2 text-xl font-semibold tracking-tight text-sky-600']) }}>
    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 2l3 7h7l-5.5 4.2L18 21l-6-4-6 4 1.5-7.8L2 9h7z" fill="currentColor" opacity=".15"/>
        <path d="M12 2l3 7h7l-5.5 4.2L18 21l-6-4-6 4 1.5-7.8L2 9h7z" stroke-linejoin="round" stroke-linecap="round"/>
    </svg>
    <span>Traveloka</span>
</div>
