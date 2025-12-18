<!DOCTYPE html>
{{--
    Ghi chú (Tiếng Việt):
    - Layout `guest` dùng cho các trang auth và landing không cần navigation chính.
    - Giữ tối giản để tập trung vào nội dung auth/marketing.
--}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Traveloka') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen traveloka-gradient">
        <div class="min-h-screen flex flex-col lg:flex-row">
            <div class="hidden lg:flex lg:w-1/2 flex-col justify-between px-16 py-12 text-white">
                <div>
                    <x-application-logo class="text-white text-2xl" />
                    <p class="mt-6 text-base text-white/80 max-w-md">
                        Trải nghiệm đặt tour thông minh với Traveloka: tìm kiếm, so sánh và chốt đơn trong vài phút.
                    </p>
                </div>
                <div class="space-y-3">
                    <div class="bg-white/15 rounded-2xl p-5 backdrop-blur">
                        <p class="text-sm text-white/70">Khách hàng nói</p>
                        <p class="mt-2 text-lg font-semibold">“Ứng dụng có giao diện đẹp, dễ dùng và chăm sóc khách hàng tuyệt vời.”</p>
                        <p class="mt-2 text-sm text-white/70">— Thu Hà, Hà Nội</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex items-center justify-center px-6 py-12">
                <div class="w-full">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
