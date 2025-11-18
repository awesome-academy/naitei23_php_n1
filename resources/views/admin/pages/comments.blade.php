@php
    use Illuminate\Support\Str;
@endphp

@extends('admin.layouts.app')

@section('page-title', 'Bình luận')

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div class="table-title">Bình luận gần đây</div>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Người dùng</th>
                    <th>Đối tượng</th>
                    <th>Nội dung</th>
                    <th>Ngày</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <td>{{ $comment->user->name ?? 'Ẩn danh' }}</td>
                        <td>
                            @php
                                $shortType = class_basename($comment->commentable_type);
                            @endphp
                            <span class="chip">{{ $shortType }}</span>
                        </td>
                        <td>{{ Str::limit($comment->body, 100) }}</td>
                        <td>{{ optional($comment->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">Chưa có bình luận</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $comments->links() }}
        </div>
    </div>
@endsection

