@extends('admin.layouts.app')

@section('page-title', 'Quản lý người dùng')

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div>
                <div class="table-title">Danh sách người dùng</div>
                <small style="color: var(--traveloka-muted);">
                    Tổng cộng {{ number_format($users->total()) }} tài khoản
                </small>
            </div>
            <div style="display: flex; gap: 12px;">
                <input
                    type="search"
                    placeholder="Tìm theo tên hoặc email..."
                    class="search-input"
                    data-table-search="#users-table"
                    style="min-width: 240px;"
                >
            </div>
        </div>

        <table class="admin-table" id="users-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Thông tin</th>
                    <th>Vai trò</th>
                    <th>Email xác thực</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong><br>
                            <small style="color: var(--traveloka-muted);">{{ $user->email }}</small>
                        </td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="chip" style="margin-right: 4px;">{{ $role->name }}</span>
                            @endforeach
                            @if ($user->roles->isEmpty())
                                <span class="status-badge status-pending">Chưa gán</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->email_verified_at)
                                <span class="status-badge status-success">Đã xác thực</span>
                            @else
                                <span class="status-badge status-pending">Chưa xác thực</span>
                            @endif
                        </td>
                        <td>{{ optional($user->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Chưa có người dùng</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection

