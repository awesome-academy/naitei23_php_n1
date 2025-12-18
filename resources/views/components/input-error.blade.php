@props(['messages'])

{{-- Ghi chú (Tiếng Việt):
    - Hiển thị lỗi cho từng input, nhận mảng `messages`.
    - Dùng component này dưới input để show validation error tương ứng.
--}}
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-2 text-sm text-red-600 dark:text-red-400']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

