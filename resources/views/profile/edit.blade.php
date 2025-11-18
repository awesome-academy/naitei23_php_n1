<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800">{{ __('Hồ sơ cá nhân') }}</h2>
            <p class="text-sm text-slate-500 mt-1">Quản lý thông tin tài khoản và cài đặt bảo mật của bạn.</p>
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
                        <p class="text-xs uppercase tracking-wide text-sky-600 font-semibold">Trạng thái</p>
                        <p class="mt-1 font-medium">
                            {{ Auth::user()->email_verified_at ? __('Đã xác thực') : __('Chưa xác thực') }}
                        </p>
                    </div>
                    <div class="p-4 rounded-2xl bg-orange-50">
                        <p class="text-xs uppercase tracking-wide text-orange-500 font-semibold">Tham gia</p>
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