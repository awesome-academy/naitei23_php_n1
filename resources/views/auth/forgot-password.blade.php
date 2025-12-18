<x-guest-layout>
    {{-- Ghi chú (Tiếng Việt):
        - Trang yêu cầu đặt lại mật khẩu: nhập email để nhận link khôi phục.
        - Sử dụng route `password.email` để gửi email chứa token.
    --}}
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-slate-800">{{ __('common.forgot_password') }}</h1>
            <p class="mt-2 text-sm text-slate-500">
                {{ __('Enter your email and we will send you a secure link to reset it.') }}
            </p>
        </div>

        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="pt-4 space-y-3">
                <x-button class="w-full justify-center">
                    {{ __('Email Password Reset Link') }}
                </x-button>
                <a href="{{ route('login') }}" class="block text-center text-sm font-semibold text-sky-600 hover:text-sky-500">
                    {{ __('common.login') }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>