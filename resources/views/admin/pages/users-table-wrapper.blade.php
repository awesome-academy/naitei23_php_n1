{{-- Ghi chú (Tiếng Việt):
    - Wrapper cho bảng người dùng và phân trang.
    - Tách table và pagination sang partials để tiện render lại bằng AJAX.
--}}
<table class="admin-table" id="users-table">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('common.user_info') }}</th>
            <th>{{ __('common.role') }}</th>
            <th>{{ __('common.email_verified') }}</th>
            <th>{{ __('common.created_date') }}</th>
            <th style="width: 160px; text-align: center;">{{ __('common.actions') }}</th>
        </tr>
    </thead>

    @include('admin.pages.users-table', ['users' => $users])
</table>

<div class="pagination" id="paginationContainer">
    @include('admin.pages.users-pagination', ['users' => $users])
</div>

 