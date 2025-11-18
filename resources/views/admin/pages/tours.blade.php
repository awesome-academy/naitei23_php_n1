@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@section('page-title', 'Danh sách tour')

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">Tour hiện có</div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tour</th>
                    <th>Danh mục</th>
                    <th>Địa điểm</th>
                    <th>Lịch trình</th>
                    <th>Đánh giá</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tours as $tour)
                    <tr>
                        <td>{{ $tour->id }}</td>
                        <td>
                            <strong>{{ $tour->name }}</strong><br>
                            <small style="color: var(--traveloka-muted);">{{ Str::limit($tour->description, 70) }}</small>
                        </td>
                        <td>{{ $tour->category->name ?? '-' }}</td>
                        <td>{{ $tour->location }}</td>
                        <td>{{ $tour->schedules_count }} lịch</td>
                        <td>{{ number_format((float) ($tour->reviews_avg_rating ?? 0), 1) }}/5</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">Chưa có tour nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $tours->links() }}
        </div>
    </div>
@endsection

