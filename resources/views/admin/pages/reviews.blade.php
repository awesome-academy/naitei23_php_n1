@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@section('page-title', 'Đánh giá tour')

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">Tất cả đánh giá</div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Khách hàng</th>
                    <th>Tour</th>
                    <th>Rating</th>
                    <th>Nội dung</th>
                    <th>Ngày</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->name ?? 'Ẩn danh' }}</td>
                        <td>{{ $review->tour->name ?? '-' }}</td>
                        <td>
                            <span class="chip">{{ $review->rating }}/5</span>
                        </td>
                        <td>{{ Str::limit($review->content, 90) }}</td>
                        <td>{{ optional($review->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Chưa có đánh giá</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection

