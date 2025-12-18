@props(['errors'])

{{-- Ghi chú (Tiếng Việt):
    - Hiển thị danh sách lỗi validation cho form.
    - Component này được dùng tại các trang đăng ký/đăng nhập để thông báo chi tiết lỗi.
--}}
@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
