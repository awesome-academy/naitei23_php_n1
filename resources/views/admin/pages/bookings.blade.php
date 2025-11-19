@extends('admin.layouts.app')

@section('page-title', 'Đơn đặt tour')

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">Danh sách booking</div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Khách hàng</th>
                    <th>Tour</th>
                    <th>Số người</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? 'Ẩn danh' }}</td>
                        <td>{{ $booking->tourSchedule->tour->name ?? '-' }}</td>
                        <td>{{ $booking->num_participants }}</td>
                        <td>{{ number_format($booking->total_price, 0, ',', '.') }} đ</td>
                        <td>
                            <span class="status-badge status-{{ $booking->status === 'completed' ? 'success' : ($booking->status === 'cancelled' ? 'cancelled' : 'pending') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>{{ optional($booking->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">Chưa có booking</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection

