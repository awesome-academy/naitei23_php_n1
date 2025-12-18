{{-- Ghi chú (Tiếng Việt):
    - Partial `users-table` chỉ chứa body của bảng users để dễ render lại qua AJAX.
    - Đảm bảo dữ liệu `$users` truyền vào luôn đúng kiểu paginator hoặc collection.
--}}
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
                    <span class="status-badge status-pending">{{ __('common.not_assigned') }}</span>
                @endif
            </td>
            <td>
                @if ($user->email_verified_at)
                    <span class="status-badge status-success">{{ __('common.verified') }}</span>
                @else
                    <span class="status-badge status-pending">{{ __('common.not_verified') }}</span>
                @endif
            </td>
            <td>{{ optional($user->created_at)->format('d/m/Y') }}</td>
            <td>
                <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                    <button class="btn btn-warning btn-sm btn-action edit-user-btn" 
                            data-user-id="{{ $user->id }}"
                            data-user-name="{{ $user->name }}"
                            data-user-email="{{ $user->email }}"
                            data-user-roles="{{ $user->roles->pluck('id')->toJson() }}"
                            title="{{ __('common.edit_user') }}">
                        <i class="fas fa-edit"></i>
                        <span>{{ __('common.edit') }}</span>
                    </button>
                    <button class="btn btn-danger btn-sm btn-action delete-user-btn" 
                            data-user-id="{{ $user->id }}"
                            title="{{ __('common.delete_user') }}">
                        <i class="fas fa-trash"></i>
                        <span>{{ __('common.delete') }}</span>
                    </button>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="empty-state">{{ __('common.no_users') }}</td>
        </tr>
    @endforelse
</tbody>

