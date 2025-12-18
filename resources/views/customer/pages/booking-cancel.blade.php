@extends('customer.layouts.app')

{{-- Ghi chú (Tiếng Việt):
    - Trang thông báo khi thanh toán/cập nhật đặt chỗ bị hủy.
    - Thông thường sẽ cung cấp hướng dẫn liên hệ hoặc thử lại thao tác.
--}}
@section('title', __('common.payment_cancelled'))

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <div class="glass-card rounded-3xl p-8 text-center">
        <div class="mb-6">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-times-circle text-4xl text-red-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">{{ __('common.payment_cancelled') }}</h1>
            <p class="text-slate-600">{{ __('common.payment_cancelled_message') }}</p>
        </div>

        <div class="mb-6 p-6 bg-slate-50 rounded-xl text-left">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">{{ __('common.booking_details') }}</h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-600">{{ __('common.booking_id') }}:</span>
                    <span class="font-semibold text-slate-800">#{{ $booking->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">{{ __('common.tour') }}:</span>
                    <span class="font-semibold text-slate-800">{{ $booking->tourSchedule->tour->name ?? __('common.tour_not_found') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">{{ __('common.status') }}:</span>
                    <span class="font-semibold text-red-600">{{ __('common.cancelled') }}</span>
                </div>
            </div>
        </div>

        <div class="flex gap-4 justify-center">
            <a href="{{ route('customer.tours', $booking->tourSchedule->tour->id) }}" class="bg-sky-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-sky-700 transition-colors">
                {{ __('common.try_again') }}
            </a>
            <a href="{{ route('home') }}" class="border border-slate-300 text-slate-700 px-6 py-3 rounded-lg font-semibold hover:bg-slate-50 transition-colors">
                {{ __('common.back_to_home') }}
            </a>
        </div>
    </div>
</div>
@endsection



