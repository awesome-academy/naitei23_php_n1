{{-- Ghi chú (Tiếng Việt):
    - Template PDF tóm tắt thông tin tour.
    - Dùng font DejaVu Sans để hỗ trợ ký tự Unicode khi render PDF từ dompdf.
--}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $tour->name }} - {{ __('common.brand') }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #111827;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 4px;
        }
        h2 {
            font-size: 16px;
            margin-top: 18px;
            margin-bottom: 6px;
        }
        .muted {
            font-size: 11px;
            color: #6b7280;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            background-color: #e0f2fe;
            color: #0369a1;
        }
        .section {
            margin-bottom: 12px;
        }
        .label {
            font-weight: 600;
        }
        .rating-stars {
            color: #facc15;
        }
        ul {
            margin: 0;
            padding-left: 16px;
        }
    </style>
</head>
<body>
    <h1>{{ $tour->name }}</h1>
    <div class="muted">
        {{ $tour->location }} &mdash;
        {{ __('common.generated_at') }}: {{ $generatedAt->format('d/m/Y H:i') }}
    </div>

    <div class="section">
        <span class="label">{{ __('common.average_rating') }}: </span>
        @php
            $reviewsCount = $tour->reviews_count ?? 0;
            $avgRating = $tour->reviews_avg_rating ?? $tour->average_rating ?? 0;
        @endphp
        @if($reviewsCount > 0)
            <span class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($avgRating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </span>
            <span>{{ number_format($avgRating, 1) }}/5 ({{ $reviewsCount }} {{ __('common.reviews') }})</span>
        @else
            <span class="muted">{{ __('common.no_reviews_yet') }}</span>
        @endif
    </div>

    @if($tour->description)
        <h2>{{ __('common.description') }}</h2>
        <div class="section">
            <p>{{ $tour->description }}</p>
        </div>
    @endif

    <h2>{{ __('common.key_information') }}</h2>
    <div class="section">
        <ul>
            <li><span class="label">{{ __('common.location') }}:</span> {{ $tour->location }}</li>
            <li><span class="label">{{ __('common.tour_id') }}:</span> #{{ $tour->id }}</li>
        </ul>
    </div>

    <div class="section">
        <span class="badge">{{ __('common.tour_overview_pdf') }}</span>
    </div>
</body>
</html>


