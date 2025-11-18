<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traveloka</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen traveloka-gradient antialiased">
        <div class="max-w-6xl mx-auto px-6 py-10 lg:py-16">
            <div class="flex items-center justify-between">
                <x-application-logo class="text-2xl text-sky-600" />
                <div class="space-x-4 text-sm font-semibold text-slate-600">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sky-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-sky-600">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-sky-600 text-white hover:bg-sky-500">
                                    Đăng ký
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="mt-14 grid gap-12 lg:grid-cols-2 items-center">
                <div>
                    <p class="text-sm font-semibold text-sky-600 uppercase">Du lịch dễ dàng</p>
                    <h1 class="mt-4 text-4xl lg:text-5xl font-bold text-slate-900 leading-snug">
                        Khám phá Việt Nam với <span class="text-sky-600">Traveloka</span>
                    </h1>
                    <p class="mt-6 text-lg text-slate-600">
                        Đặt tour, khách sạn và trải nghiệm địa phương trong vài phút. Hơn 5 triệu người dùng
                        tin tưởng Traveloka để lên kế hoạch cho hành trình của mình.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="traveloka-button bg-gradient-to-r from-sky-600 to-blue-600 text-white shadow-xl">
                            Bắt đầu ngay
                        </a>
                        <a href="{{ route('login') }}" class="traveloka-button bg-white text-sky-600 border border-sky-100">
                            Tôi đã có tài khoản
                        </a>
                    </div>
                    <div class="mt-8 flex items-center gap-6 text-sm text-slate-500">
                        <div>
                            <p class="text-2xl font-semibold text-slate-900">4.9/5</p>
                            <p>Đánh giá từ người dùng</p>
                        </div>
                        <div>
                            <p class="text-2xl font-semibold text-slate-900">+1.2k</p>
                            <p>Tour mới mỗi tháng</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-[32px] p-10 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-sky-100 via-transparent to-white opacity-80"></div>
                    <div class="relative space-y-6 text-slate-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">Khởi hành</p>
                                <p class="text-xl font-semibold text-slate-900">Hà Giang</p>
                                <p class="text-sm text-slate-500">24 - 26 Nov</p>
                            </div>
                            <span class="px-4 py-2 rounded-full bg-sky-50 text-sky-600 text-sm font-semibold">
                                Đã xác nhận
                            </span>
                        </div>
                        <hr class="border-slate-100">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">Khám phá nổi bật</p>
                            <ul class="space-y-2 text-sm">
                                <li>• Cột mốc Lũng Cú</li>
                                <li>• Đèo Mã Pí Lèng</li>
                                <li>• Phiên chợ Đồng Văn</li>
                            </ul>
                        </div>
                        <div class="mt-6 p-5 rounded-2xl bg-white shadow-inner text-sm">
                            “Dịch vụ chuyên nghiệp, lịch trình rõ ràng và đội ngũ hướng dẫn viên tận tâm.
                            Traveloka là lựa chọn số 1 của gia đình tôi.”
                            <p class="mt-3 font-semibold text-slate-800">— Gia Hưng, HCM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

