@php
    use Illuminate\Support\Str;

    $authUser = auth()->user();
    $initials = $authUser ? Str::of($authUser->name)->trim()->explode(' ')->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('') : 'AD';
@endphp

<header class="admin-header">
    <div class="header-left">
        <div class="header-title">{{ $pageTitle ?? 'Bảng điều khiển' }}</div>
        <div class="header-breadcrumb">
            Traveloka Admin • {{ $pageTitle ?? 'Bảng điều khiển' }}
        </div>
    </div>

    <div class="header-actions">
        <div class="user-pill">
            <div class="user-avatar">{{ Str::upper($initials) }}</div>
            <div>
                <div style="font-weight: 600; color: var(--traveloka-slate);">
                    {{ $authUser?->name ?? 'Admin' }}
                </div>
                <div class="chip">Super Admin</div>
            </div>
            <div style="position: relative;">
                <svg width="16" height="16" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="m6 9 6 6 6-6" />
                </svg>
                <div class="user-menu">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

