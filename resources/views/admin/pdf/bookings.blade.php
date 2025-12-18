{{-- Ghi chú (Tiếng Việt):
    - Template PDF báo cáo booking cho admin.
    - Sử dụng kiểu chữ DejaVu Sans để hiển thị tiếng Việt đúng trong PDF.
    - Tránh chèn các script hoặc assets ngoài cho file PDF này.
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Bookings Report</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #111827;
        }
        h1 {
            font-size: 18px;
            margin-bottom: 4px;
        }
        .subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 6px 8px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: 600;
        }
        .text-right {
            text-align: right;
        }
        .status-badge {
            padding: 2px 6px;
            border-radius: 999px;
            font-size: 10px;
            display: inline-block;
        }
        .status-success {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .small {
            font-size: 9px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <h1>Bookings Report</h1>
    <div class="subtitle">
        Generated at: {{ $generatedAt->format('d/m/Y H:i') }} &mdash;
        Total bookings: {{ $bookings->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Tour</th>
                <th>Participants</th>
                <th class="text-right">Total Price (VND)</th>
                <th>Status</th>
                <th>Booked At</th>
            </tr>
        </thead>
        <tbody>
        @forelse($bookings as $booking)
            <tr>
                <td>#{{ $booking->id }}</td>
                <td>
                    {{ $booking->user->name ?? 'Anonymous' }}<br>
                    @if($booking->user && $booking->user->email)
                        <span class="small">{{ $booking->user->email }}</span>
                    @endif
                </td>
                <td>
                    {{ $booking->tourSchedule->tour->name ?? '-' }}<br>
                    @if($booking->tourSchedule && $booking->tourSchedule->start_date)
                        <span class="small">
                            {{ optional($booking->tourSchedule->start_date)->format('d/m/Y') }}
                            -
                            {{ optional($booking->tourSchedule->end_date)->format('d/m/Y') }}
                        </span>
                    @endif
                </td>
                <td class="text-right">{{ $booking->num_participants }}</td>
                <td class="text-right">
                    {{ number_format($booking->total_price, 0, ',', '.') }}
                </td>
                <td>
                    @php
                        $statusClass = $booking->status === 'completed'
                            ? 'status-success'
                            : ($booking->status === 'cancelled' ? 'status-cancelled' : 'status-pending');
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td>{{ optional($booking->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No bookings available.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>


