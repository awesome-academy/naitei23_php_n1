@extends('admin.layouts.app')

@section('page-title', __('common.user_management'))

@section('content')
    <div class="table-wrapper">
        <div class="table-head">
            <div>
                <div class="table-title">{{ __('common.user_list') }}</div>
                <small style="color: var(--traveloka-muted);">
                    {{ __('common.total_accounts') }} {{ number_format($users->total()) }} {{ __('common.users') }}
                </small>
            </div>
            <div style="display: flex; gap: 12px;">
                <input
                    type="search"
                    placeholder="{{ __('common.search_by_name_or_email') }}"
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
                    <th>{{ __('common.user_info') }}</th>
                    <th>{{ __('common.role') }}</th>
                    <th>{{ __('common.email_verified') }}</th>
                    <th>{{ __('common.created_date') }}</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">{{ __('common.no_users') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection

