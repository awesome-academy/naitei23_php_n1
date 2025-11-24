@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@section('page-title', __('common.payments'))

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">{{ __('common.payment_history') }}</div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>{{ __('common.transaction_id') }}</th>
                    <th>{{ __('common.customer') }}</th>
                    <th>{{ __('common.booking') }}</th>
                    <th>{{ __('common.amount') }}</th>
                    <th>{{ __('common.payment_method') }}</th>
                    <th>{{ __('common.status') }}</th>
                    <th>{{ __('common.payment_date') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                        <td>{{ $payment->booking->user->name ?? __('common.anonymous') }}</td>
                        <td>#{{ $payment->booking_id }}</td>
                        <td>{{ number_format($payment->amount, 0, ',', '.') }} {{ __('common.vnd') }}</td>
                        <td>{{ Str::upper($payment->payment_method) }}</td>
                        <td>
                            @php
                                $statusClass = $payment->status === 'success'
                                    ? 'status-success'
                                    : ($payment->status === 'failed' ? 'status-cancelled' : 'status-pending');
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ __("common.{$payment->status}") }}</span>
                        </td>
                        <td>{{ optional($payment->payment_date)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">{{ __('common.no_payments') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $payments->links() }}
        </div>
    </div>
@endsection

