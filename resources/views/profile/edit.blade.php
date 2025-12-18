{{--
    Ghi chú (Tiếng Việt):
    - Trang profile edit cho phép người dùng cập nhật thông tin, đổi mật khẩu và xóa tài khoản.
    - Các phần chức năng đã tách thành partials trong `profile.partials` để dễ bảo trì.
--}}
<x-app-layout>
    @if(session('welcome_message'))
        <div id="welcome-banner"
             class="mb-6 px-4 py-3 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-between shadow">
            <span>{{ session('welcome_message') }}</span>
            <button type="button"
                    id="close-welcome-banner"
                    class="font-semibold"
                    aria-label="{{ __('common.close') }}">
                &times;
            </button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const closeButton = document.getElementById('close-welcome-banner');
                const banner = document.getElementById('welcome-banner');
                if (closeButton && banner) {
                    closeButton.addEventListener('click', function() {
                        banner.style.display = 'none';
                    });
                }
            });
        </script>
    @endif
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">{{ __('common.profile') }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ __('common.profile_subtitle') }}</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="grid gap-5 lg:grid-cols-2">
            <div class="glass-card rounded-3xl p-8">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center text-xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6 text-sm text-slate-600">
                    <div class="p-4 rounded-2xl bg-sky-50">
                        <p class="text-xs uppercase tracking-wide text-sky-600 font-semibold">{{ __('common.status') }}</p>
                        <p class="mt-1 font-medium">
                            {{ Auth::user()->email_verified_at ? __('common.verified') : __('common.not_verified') }}
                        </p>
                    </div>
                    <div class="p-4 rounded-2xl bg-orange-50">
                        <p class="text-xs uppercase tracking-wide text-orange-500 font-semibold">{{ __('common.joined') }}</p>
                        <p class="mt-1 font-medium">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="glass-card rounded-3xl p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="glass-card rounded-3xl p-8 border border-red-50 bg-gradient-to-br from-white to-red-50/40">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>