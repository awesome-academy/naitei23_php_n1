<x-guest-layout>
    {{--
        Ghi chú (Tiếng Việt):
        - Đây là trang đăng nhập cho khu vực admin.
        - Chỉ cho phép tài khoản có quyền admin đăng nhập.
        - Các validation và thông báo lỗi sẽ hiển thị ngay phía dưới.
    --}}
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ __('common.admin_login') }}</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('common.please_login_with_admin_account') }}
        </p>
    </div>

    {{-- Hiển thị danh sách lỗi validation (nếu có) để admin dễ sửa thông tin --}}
    @if ($errors->any())
        <div class="mb-4 rounded border border-red-300 bg-red-50 p-3 text-sm text-red-700 dark:border-red-700 dark:bg-red-900/20 dark:text-red-200">
            <ul class="list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form đăng nhập admin: gửi về route `admin.login.store` để xử lý xác thực --}}
    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div>
            <x-input-label for="password" :value="__('common.password')" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                <input id="remember" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2">{{ __('common.remember_me') }}</span>
            </label>

            <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                {{ __('common.back_to_home') }}
            </a>
        </div>

        <div>
            <x-primary-button class="w-full justify-center">
                {{ __('common.login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

