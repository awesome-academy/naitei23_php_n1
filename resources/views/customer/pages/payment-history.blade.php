@extends('customer.layouts.app')

@section('title', __('common.payment_history'))

@section('content')
<div class="py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ __('common.payment_history') }}</h1>
        <p class="text-slate-600">{{ __('common.payment_history_description') }}</p>
    </div>

    @if($payments->count() > 0)
        <div class="glass-card rounded-3xl p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-700">{{ __('common.invoice_id') }}</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-700">{{ __('common.tour') }}</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-slate-700">{{ __('common.payment_date') }}</th>
                            <th class="text-right py-3 px-4 text-sm font-semibold text-slate-700">{{ __('common.total_amount') }}</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-slate-700">{{ __('common.status') }}</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-slate-700">{{ __('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="py-4 px-4">
                                    <span class="font-mono text-sm text-slate-800">{{ $payment->invoice_id ?? 'N/A' }}</span>
                                </td>
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            {{ $payment->booking->tourSchedule->tour->name ?? __('common.tour_not_found') }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ __('common.booking_id') }}: #{{ $payment->booking->id }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="text-sm text-slate-600">
                                        {{ $payment->payment_date ? $payment->payment_date->format('d/m/Y H:i') : 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <span class="font-semibold text-sky-600">
                                        {{ number_format($payment->amount, 0, ',', '.') }} {{ __('common.vnd') }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($payment->status === 'success') bg-green-100 text-green-700
                                        @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ __('common.' . $payment->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <a href="{{ route('invoice.download', $payment) }}" 
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 text-white rounded-lg text-sm font-semibold hover:bg-sky-700 transition-colors shadow-sm">
                                        <i class="fas fa-file-pdf"></i>
                                        {{ __('common.download_pdf') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $payments->links() }}
            </div>
        </div>
    @else
        <div class="glass-card rounded-3xl p-12 text-center">
            <i class="fas fa-receipt text-6xl text-slate-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-slate-800 mb-2">{{ __('common.no_payments_found') }}</h3>
            <p class="text-slate-600 mb-6">{{ __('common.no_payments_description') }}</p>
            <a href="{{ route('customer.categories') }}" class="inline-block bg-sky-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-sky-700 transition-colors shadow-sm">
                {{ __('common.browse_tours') }}
            </a>
        </div>
    @endif
</div>
@endsection

