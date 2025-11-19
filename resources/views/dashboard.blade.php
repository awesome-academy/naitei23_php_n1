<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">{{ __('Bảng điều khiển') }}</h2>
            <p class="text-sm text-slate-500 mt-1">Tổng quan nhanh về hoạt động tài khoản và chuyến đi của bạn.</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('Chuyến đi sắp tới') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">02</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('Hà Giang, Đà Lạt') }}</p>
            </div>
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('Điểm tích lũy') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">1.540</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('Đổi ưu đãi tại mục Loyalty') }}</p>
            </div>
            <div class="glass-card rounded-3xl p-6">
                <p class="text-sm text-slate-500">{{ __('Ưu đãi cá nhân hóa') }}</p>
                <p class="mt-4 text-3xl font-semibold text-slate-800">5</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('Áp dụng cho tuần này') }}</p>
            </div>
        </div>

        <div class="glass-card rounded-3xl p-8">
            <h3 class="text-lg font-semibold text-slate-800">{{ __('Hoạt động gần đây') }}</h3>
            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600">
                        ✈️
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ __('Đặt tour Hà Giang 3N2Đ') }}</p>
                        <p class="text-sm text-slate-500">{{ __('Thanh toán thành công ngày 12/11') }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-500">
                        ⭐
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ __('Đánh giá tour Phú Quốc') }}</p>
                        <p class="text-sm text-slate-500">{{ __('Nhận thêm 120 điểm thưởng') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>