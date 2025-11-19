@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@section('page-title', 'Thanh toán')

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">Lịch sử thanh toán</div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Mã giao dịch</th>
                    <th>Khách hàng</th>
                    <th>Booking</th>
                    <th>Số tiền</th>
                    <th>Phương thức</th>
                    <th>Trạng thái</th>
                    <th>Ngày thanh toán</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                        <td>{{ $payment->booking->user->name ?? 'Ẩn danh' }}</td>
                        <td>#{{ $payment->booking_id }}</td>
                        <td>{{ number_format($payment->amount, 0, ',', '.') }} đ</td>
                        <td>{{ Str::upper($payment->payment_method) }}</td>
                        <td>
                            @php
                                $statusClass = $payment->status === 'success'
                                    ? 'status-success'
                                    : ($payment->status === 'failed' ? 'status-cancelled' : 'status-pending');
                            @endphp
                            <span class="status-badge {{ $statusClass }}">{{ ucfirst($payment->status) }}</span>
                        </td>
                        <td>{{ optional($payment->payment_date)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">Chưa có thanh toán</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $payments->links() }}
        </div>
    </div>
@endsection

