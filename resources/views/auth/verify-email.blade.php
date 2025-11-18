<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-slate-800">{{ __('Verify your email') }}</h1>
            <p class="mt-2 text-sm text-slate-500">
                {{ __('We have sent a verification link to your inbox. Please check your email.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-semibold text-green-600 text-center">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf

                <x-button class="w-full justify-center">
                    {{ __('Resend Verification Email') }}
                </x-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="w-full text-sm font-semibold text-slate-500 hover:text-slate-700">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>