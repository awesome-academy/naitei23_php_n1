@php
    // Force English for invoice layout
    app()->setLocale('en');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Invoice - {{ $payment->invoice_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        @page {
            margin: 10mm 12mm 10mm 10mm; /* Top Right Bottom Left */
            size: A4 portrait;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333333;
            line-height: 1.4;
            background: white;
            width: auto; 
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }
        
        /* ========== HEADER SECTION ========== */
        .header {
            border-bottom: 3px solid #0ea5e9;
            padding-bottom: 10px;
            margin-bottom: 15px;
            width: 100%;
        }
        .header-top {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .header-left {
            display: table-cell;
            width: 55%;
            vertical-align: top;
            padding-right: 15px;
        }
        .header-right {
            display: table-cell;
            width: 45%;
            text-align: right;
            vertical-align: top;
            padding-left: 10px;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #0ea5e9;
            margin-bottom: 5px;
        }
        .company-details {
            font-size: 9px;
            color: #555555;
            line-height: 1.4;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
        }
        .invoice-meta {
            font-size: 9px;
            color: #555555;
            line-height: 1.5;
        }
        .invoice-meta div {
            margin-bottom: 2px;
        }
        
        /* ========== BODY SECTION ========== */
        .section {
            margin-bottom: 15px;
            width: 100%;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0ea5e9;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 2px solid #e0e7ff;
            text-transform: uppercase;
        }
        .info-box {
            background: #f8fafc;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            width: 100%;
        }
        .two-columns {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .column {
            display: table-cell;
            width: 50%;
            padding-right: 10px;
            vertical-align: top;
        }
        .column:last-child {
            padding-right: 0;
        }
        .info-row {
            margin-bottom: 6px;
            font-size: 10px;
            /* FIX: Đảm bảo dòng có chiều cao tối thiểu */
            min-height: 14px; 
        }
        .info-label {
            font-weight: 600;
            color: #555555;
            display: inline-block;
            /* FIX: Tăng width lên 110px để chứa đủ chữ Payment Method */
            width: 110px; 
            font-size: 9px;
            /* FIX: Căn chỉnh theo cạnh trên để thẳng hàng */
            vertical-align: top; 
        }
        .info-value {
            color: #333333;
            font-weight: 500;
            font-size: 10px;
            display: inline-block; /* Đảm bảo nó ứng xử như khối */
            /* FIX: Căn chỉnh theo cạnh trên để thẳng hàng với label */
            vertical-align: top;
            /* FIX: Giới hạn chiều rộng còn lại để tránh vỡ layout nếu text quá dài */
            max-width: calc(100% - 115px); 
        }
        
        /* ========== TABLE SECTION ========== */
        .table-wrapper {
            width: 100%;
            margin-top: 5px;
        }
        .table {
            width: 99%;
            border-collapse: collapse;
            background: white;
            font-size: 9px;
            border: 1px solid #ddd;
            table-layout: fixed;
        }
        .table thead {
            background: #f2f2f2;
        }
        .table th {
            color: #333333;
            padding: 8px 4px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #0ea5e9;
            border-right: 1px solid #ddd;
            overflow: hidden;
        }
        .table th:last-child { border-right: none; }
        .table td {
            padding: 8px 4px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            font-size: 9px;
            color: #333333;
            vertical-align: middle;
        }
        .table td:last-child { border-right: none; }
        .table tbody tr:hover { background-color: #f8fafc; }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .amount-column {
            white-space: nowrap;
        }
        
        /* ========== SUMMARY SECTION ========== */
        .summary-section {
            margin-top: 15px;
            width: 100%;
        }
        .summary-box {
            background: #f8fafc;
            border: 2px solid #0ea5e9;
            border-radius: 6px;
            padding: 10px 12px;
            width: auto; 
            margin-right: 2px;
            box-sizing: border-box;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto; 
        }
        .summary-row td {
            padding: 4px 0;
        }
        .summary-label {
            text-align: left;
            font-weight: 600;
            color: #555555;
            font-size: 10px;
            width: auto;
            padding-right: 10px;
        }
        .summary-value {
            text-align: right;
            font-weight: 600;
            color: #333333;
            font-size: 10px;
            width: auto;
            white-space: nowrap;
            padding-left: 5px;
        }
        .summary-divider {
            border-top: 1px solid #ddd;
            margin: 6px 0;
        }
        .total-row {
            padding-top: 8px;
            border-top: 2px solid #0ea5e9;
            margin-top: 8px;
        }
        .total-label {
            color: #000000;
            font-weight: bold;
            font-size: 13px;
        }
        .total-value {
            color: #000000;
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
        }
        
        /* ========== STATUS BADGE ========== */
        .status-badge {
            display: inline-block;
            padding: 4px 10px; 
            border-radius: 4px; 
            font-size: 9px;
            font-weight: bold;
            color: #ffffff !important; 
            line-height: 1;
            border: 1px solid transparent; 
        }
        
        .status-success {
            background-color: #10b981 !important; 
            border-color: #059669;
        }
        .status-pending {
            background-color: #f59e0b !important; 
            border-color: #d97706;
        }
        .status-failed {
            background-color: #ef4444 !important; 
            border-color: #dc2626;
        }

        /* ========== OTHER ========== */
        .payment-details {
            background: #e0f2fe;
            padding: 10px;
            border-radius: 4px;
            border-left: 4px solid #0ea5e9;
            width: 100%;
            margin-top: 15px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
        }
        .no-break { page-break-inside: avoid; }
    </style>
</head>
<body>
    {{-- LOGIC XỬ LÝ TRẠNG THÁI --}}
    @php
        $rawStatus = $payment->status ?? '';
        if (trim($rawStatus) === '' && $payment->invoice_id) {
            $rawStatus = 'success';
        }
        $rawStatus = $rawStatus ?: 'pending';
        $statusNorm = strtolower($rawStatus);
        
        if ($statusNorm === 'pending') {
            $statusClass = 'status-pending';
            $statusText = 'PENDING';
        } elseif (in_array($statusNorm, ['failed', 'cancelled', 'canceled'])) {
            $statusClass = 'status-failed';
            $statusText = 'FAILED';
        } else {
            $statusClass = 'status-success';
            // Treat success/completed as PAID
            $statusText = 'PAID';
        }
    @endphp

    <div class="container">
        <div class="header no-break">
            <div class="header-top">
                <div class="header-left">
                    <div class="company-name">{{ $company['name'] }}</div>
                    <div class="company-details">
                        {{ $company['address'] }}<br>
                        Phone: {{ $company['phone'] }} | Email: {{ $company['email'] }}
                        @if(isset($company['tax_id']) && $company['tax_id'])
                            <br>Tax ID: {{ $company['tax_id'] }}
                        @endif
                    </div>
                </div>
                <div class="header-right">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-meta">
                        <div><strong>Invoice ID:</strong> {{ $payment->invoice_id }}</div>
                        <div><strong>Date:</strong> {{ $payment->payment_date ? $payment->payment_date->format('M d, Y') : 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section no-break">
            <div class="section-title">Customer Information</div>
            <div class="info-box">
                <div class="two-columns">
                    <div class="column">
                        <div class="info-row">
                            <span class="info-label">Name:</span>
                            <span class="info-value">{{ $customer->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email:</span>
                            <span class="info-value">{{ $customer->email }}</span>
                        </div>
                    </div>
                    <div class="column">
                        <div class="info-row">
                            <span class="info-label">Payment Method:</span>
                            <span class="info-value">{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section no-break">
            <div class="section-title">Tour Information</div>
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 28%;">Tour Name</th>
                            <th style="width: 13%;" class="text-center">Departure</th>
                            <th style="width: 13%;" class="text-center">End Date</th>
                            <th style="width: 8%;" class="text-center">Guests</th>
                            <th style="width: 18%;" class="text-right">Unit Price</th>
                            <th style="width: 20%;" class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>{{ $tour->name ?? 'N/A' }}</strong></td>
                            <td class="text-center">{{ $tourSchedule->start_date ? $tourSchedule->start_date->format('M d, Y') : 'N/A' }}</td>
                            <td class="text-center">{{ $tourSchedule->end_date ? $tourSchedule->end_date->format('M d, Y') : 'N/A' }}</td>
                            <td class="text-center"><strong>{{ $booking->num_participants }}</strong></td>
                            <td class="text-right amount amount-column">{{ number_format($tourSchedule->price, 0, ',', '.') }}</td>
                            <td class="text-right amount amount-column"><strong>{{ number_format($booking->total_price, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="summary-section no-break">
            <div class="summary-box">
                <table class="summary-table">
                    <tr class="summary-row">
                        <td class="summary-label">Subtotal:</td>
                        <td class="summary-value">{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @if(isset($tax) && $tax > 0)
                    <tr class="summary-row">
                        <td class="summary-label">Tax ({{ $taxRate ?? 10 }}%):</td>
                        <td class="summary-value">{{ number_format($tax, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr class="summary-row">
                        <td colspan="2"><div class="summary-divider"></div></td>
                    </tr>
                    <tr class="summary-row total-row">
                        <td class="summary-label total-label">TOTAL:</td>
                        <td class="summary-value total-value">{{ number_format($payment->amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="payment-details no-break">
            <div class="info-row">
                <span class="info-label">Transaction ID:</span>
                <span class="info-value" style="font-size: 9px; word-break: break-all;">{{ $payment->transaction_id ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Booking ID:</span>
                <span class="info-value"><strong>#{{ $booking->id }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Date:</span>
                <span class="info-value"><strong>{{ $payment->payment_date ? $payment->payment_date->format('M d, Y H:i') : 'N/A' }}</strong></span>
            </div>
        </div>

        <div class="footer no-break">
            <p><strong>Thank you for your booking!</strong></p>
            <p class="footer-note">Invoice generated on: {{ now()->format('M d, Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>