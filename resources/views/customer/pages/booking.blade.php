@extends('customer.layouts.app')

{{-- Ghi chú (Tiếng Việt):
    - Trang booking chứa form đặt chỗ cho một lịch trình tour.
    - Có phần tính toán giá dựa trên exchange rate; logic này có thể chuyển sang JS riêng.
--}}
@section('title', __('common.book_tour'))

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card rounded-3xl p-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-6">{{ __('common.book_tour') }}</h1>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tour Information -->
        <div class="mb-8 p-6 bg-slate-50 rounded-2xl">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">{{ $schedule->tour->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-slate-500">{{ __('common.start_date') }}:</span>
                    <span class="font-semibold text-slate-800 ml-2">{{ $schedule->start_date->format('d/m/Y') }}</span>
                </div>
                <div>
                    <span class="text-slate-500">{{ __('common.end_date') }}:</span>
                    <span class="font-semibold text-slate-800 ml-2">{{ $schedule->end_date->format('d/m/Y') }}</span>
                </div>
                <div>
                    <span class="text-slate-500">{{ __('common.price_per_person') }}:</span>
                    <span class="font-semibold text-sky-600 ml-2">{{ number_format($schedule->price, 0, ',', '.') }} {{ __('common.vnd') }}</span>
                </div>
                <div>
                    <span class="text-slate-500">{{ __('common.available_slots') }}:</span>
                    <span class="font-semibold text-slate-800 ml-2">{{ $schedule->available_slots }} {{ __('common.slots') }}</span>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <form method="POST" action="{{ route('booking.store', $schedule) }}" class="space-y-6">
            @csrf

            <div>
                <label for="num_participants" class="block text-sm font-medium text-slate-700 mb-2">
                    {{ __('common.number_of_participants') }}
                </label>
                <input 
                    type="number" 
                    id="num_participants" 
                    name="num_participants" 
                    min="1" 
                    max="{{ $schedule->available_slots }}"
                    value="{{ old('num_participants', 1) }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-sky-500 focus:ring-sky-500"
                >
                <p class="mt-2 text-sm text-slate-500">
                    {{ __('common.max_participants') }}: {{ $schedule->max_participants }}, 
                    {{ __('common.available') }}: {{ $schedule->available_slots }}
                </p>
            </div>

            <!-- Price Calculation -->
            <div class="p-6 bg-sky-50 rounded-xl">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-600">{{ __('common.price_per_person') }}:</span>
                    <span class="font-semibold text-slate-800" id="price-per-person">{{ number_format($schedule->price, 0, ',', '.') }} {{ __('common.vnd') }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-600">{{ __('common.number_of_participants') }}:</span>
                    <span class="font-semibold text-slate-800" id="participants-count">1</span>
                </div>
                <div class="border-t border-sky-200 pt-4 mt-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-lg font-semibold text-slate-800">{{ __('common.total_price') }}:</span>
                    <span class="text-2xl font-bold text-sky-600" id="total-price">{{ number_format($schedule->price, 0, ',', '.') }} {{ __('common.vnd') }}</span>
                </div>
                    <div class="text-xs text-slate-500 text-right mt-1" id="usd-equivalent">
                        (≈ $<span id="usd-amount">0</span> USD)
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-sky-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-sky-700 transition-colors"
                >
                    <i class="fas fa-credit-card mr-2"></i>
                    {{ __('common.proceed_to_payment') }}
                </button>
                <a 
                    href="{{ route('customer.tours', $schedule->tour->id) }}" 
                    class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition-colors"
                >
                    {{ __('common.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

@php
    // Get exchange rate from API or fallback to config
    $exchangeRate = config('services.exchange_rate.enabled', true)
        ? \App\Services\ExchangeRateService::getRate()
        : config('services.stripe.vnd_to_usd_rate', 25000);
@endphp

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const numParticipantsInput = document.getElementById('num_participants');
        const pricePerPerson = {{ $schedule->price }};
        const participantsCount = document.getElementById('participants-count');
        const totalPrice = document.getElementById('total-price');
        const usdAmount = document.getElementById('usd-amount');
        const exchangeRate = {{ $exchangeRate }};

        function updatePrice() {
            const numParticipants = parseInt(numParticipantsInput.value) || 1;
            const totalVND = pricePerPerson * numParticipants;
            const totalUSD = totalVND / exchangeRate;
            
            participantsCount.textContent = numParticipants;
            totalPrice.textContent = new Intl.NumberFormat('vi-VN').format(totalVND) + ' {{ __('common.vnd') }}';
            usdAmount.textContent = totalUSD.toFixed(2);
        }

        numParticipantsInput.addEventListener('input', updatePrice);
        updatePrice();
    });
</script>
@endpush
@endsection

