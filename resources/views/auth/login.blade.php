<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-8 text-center">
            <h1 class="text-2xl font-semibold text-slate-800">{{ __('common.login') }}</h1>
            <p class="mt-2 text-sm text-slate-500">{{ __('common.welcome_back_traveloka') }}</p>
        </div>

        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div>
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-sm text-slate-500">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-sky-600 shadow-sm focus:ring-sky-200" name="remember">
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-sky-600 hover:text-sky-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="pt-4">
                <x-button class="w-full justify-center">
                    {{ __('Log in') }}
                </x-button>

                <p class="mt-4 text-center text-sm text-slate-500">
                    {{ __('common.new_to_traveloka') }}
                    <a class="font-semibold text-sky-600 hover:text-sky-500" href="{{ route('register') }}">
                        {{ __('common.create_account') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>